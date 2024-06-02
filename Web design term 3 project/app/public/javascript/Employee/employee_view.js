
import ErrorHandler from "../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

let nextScanning = true;

document.getElementById("startButton").addEventListener("click", () => {
  const button = document.getElementById("startButton");

  // Change the button text, color, and disable it
  button.textContent = "Scanning...";
  button.classList.remove("bg-blue-800", "hover:bg-blue-700");
  button.classList.add("bg-blue-300");
  button.disabled = true;

  const codeReader = new ZXing.BrowserQRCodeReader();
  console.log("ZXing code reader initialized");

  codeReader
    .getVideoInputDevices()
    .then((videoInputDevices) => {
      const firstDeviceId = videoInputDevices[0].deviceId;
      codeReader.decodeFromVideoDevice(
        firstDeviceId,
        "video",
        (result) => {
          if (result && nextScanning) {
            nextScanning = false;
            fetch(`/api/employee/getTicketStatus?ticketID=${result.text}`, {
              method: "GET",
              headers: {
                "Content-Type": "application/json",
              },
            })
              .then((response) => response.json())
              .then((data) => {
                let isScanned = data.data.Scanned;
                let nameOfUser = data.nameOfUser;

                // Display the name of the user in the ticketInfoCard div
                const ticketInfoCard = document.getElementById("ticketInfoCard");
                ticketInfoCard.innerHTML = `<p>Ticket Owner: ${nameOfUser}</p>`;

                if (isScanned) {
                  // Ticket already scanned
                  errorHandler.showAlertWithPromise("Ticket already scanned!", {
                    showConfirmButton: true
                  }).then(() => {
                    nextScanning = true;
                  });

                } else {
                  // Ticket scanned for the first time
                  fetch(`/api/employee/handleQRData?ticketID=${result.text}`, {
                    method: "PUT",
                    headers: {
                      "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ qrData: result.text }),
                  })
                    .then((response) => response.json())
                    .then(() => {
                      errorHandler.showAlertWithPromise("Ticket scanned successfully!", {
                        icon: "success",
                        title: "Success",
                        showConfirmButton: true
                      })
                        .then(() => {
                          nextScanning = true;
                        });
                    });
                }
              });
          }
        }
      );
    })
    .catch((err) => {
      console.error(err);
      nextScanning = true;
      errorHandler.showAlert("Error scanning ticket!");
      button.textContent = "Start Scanning";
      button.classList.remove("bg-blue-300");
      button.classList.add("bg-blue-800", "hover:bg-blue-700");
      button.disabled = false;
    });
});


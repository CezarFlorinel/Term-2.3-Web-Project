import { handleApiResponse } from "../Utilities/handle_data_checks.js";
import ErrorHandler from "../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

let scanned = false;

document.getElementById("startButton").addEventListener("click", () => {
  const codeReader = new ZXing.BrowserQRCodeReader();
  console.log("ZXing code reader initialized");

  codeReader
    .getVideoInputDevices()
    .then((videoInputDevices) => {
      const firstDeviceId = videoInputDevices[0].deviceId;
      codeReader.decodeFromVideoDevice(
        firstDeviceId,
        "video",
        (result, err) => {
          if (result) {
            console.log(result);
            fetch(`/api/employee/getTicketStatus?ticketID=${result.text}`,
            {
                method: "GET",
                headers: {
                "Content-Type": "application/json",
                }
            }
            )
            .then((response) => response.json())
            .then((data) => {
                if (data.data.Scanned) {
                //Ticket already scanned
                //scanned = true;
                console.log("Ticket already scanned!");
                //show pop up message
                } else {
                // Ticket scanned for the first time
                //scanned = false;
                fetch(`/api/employee/handleQRData?ticketID=${result.text}`, {
                    method: "PUT",
                    headers: {
                    "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ qrData: result.text }),
                })
                    .then((response) => response.json())
                console.log("ticket scanned successfully!");
                }
            });
          }
        }
      );
    })
    .catch((err) => {
      console.error(err);
      alert("Error initializing camera: " + err.message);
    });
});

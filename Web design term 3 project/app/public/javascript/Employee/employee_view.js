import {handleApiResponse} from "../Utilities/handle_data_checks.js";
import ErrorHandler from "../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

let scanned = false;

document.getElementById('startButton').addEventListener('click', () => {
    const codeReader = new ZXing.BrowserQRCodeReader();
    console.log('ZXing code reader initialized');

    codeReader.getVideoInputDevices()
        .then((videoInputDevices) => {
            const firstDeviceId = videoInputDevices[0].deviceId
            codeReader.decodeFromVideoDevice(firstDeviceId, 'video', (result, err) => {
                if (result) {
                    console.log(result.text)
                    fetch('/api/employee/handleQRData', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({qrData: result.text})
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                // Handle error case
                                console.error('Error:', data.error);
                                alert('Error: ' + data.error);
                            } else {
                                if (data.scanned) {
                                    // Ticket already scanned
                                    scanned = true;
                                    console.log("Ticket already scanned!");
                                    //show pop up message 
                                } else {
                                    // Ticket scanned for the first time
                                    scanned = false;
                                    console.log("ticket scanned successfully!");
                                    //displayTicketInformation();
                                    // Perform additional actions if needed
                                }
                            }
                        })
                        .catch(error => {
                            // Handle fetch or parsing errors
                            console.error('Fetch error:', error);
                            alert('Fetch error: ' + error.message);
                        });
                }
                if (err && !(err instanceof ZXing.NotFoundException)) {
                    console.error(err)
                    alert('Error scanning QR Code: ' + err.message)
                }
            })
        })
    .catch((err) => {
        console.error(err);
        alert('Error initializing camera: ' + err.message);
    })
});



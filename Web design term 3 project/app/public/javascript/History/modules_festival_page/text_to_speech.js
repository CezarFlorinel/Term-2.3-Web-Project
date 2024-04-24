import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

export function textTospeech() {
    // Check if the Web Speech API is supported
    if ('speechSynthesis' in window) {
        document.getElementById('read-aloud-button').addEventListener('click', () => {
            // Get the text you want to read
            var textToRead = document.getElementById('text-to-read').textContent;
            speak(textToRead);
        });
    } else {
        errorHandler.showAlert('Sorry, your browser doesn\'t support text to speech!', 'danger');
    }
}

function speak(text) {
    try {
        const speechSynthesis = window.speechSynthesis;
        speechSynthesis.cancel(); // Stop any previous speech

        // Split text into segments
        const segments = text.match(/.{1,200}(\s|$)/g); // Split by max length or spaces

        segments.forEach(segment => {
            const msg = new SpeechSynthesisUtterance(segment);
            msg.lang = 'en-US';
            msg.volume = 1;
            msg.rate = 1;
            msg.pitch = 1;
            speechSynthesis.speak(msg);
        });
    } catch (error) {
        errorHandler.showAlert('An error occurred while trying to read the text!', 'danger');
        errorHandler.logError(error, 'speak', 'text_to_speech.js')
    }
}
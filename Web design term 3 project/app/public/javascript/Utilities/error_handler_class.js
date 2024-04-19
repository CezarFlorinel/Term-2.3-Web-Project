class ErrorHandler {

    constructor() {
        this.apiEndpoint = '/api/errorHandlerForJs/storeError';
    }

    logError(error, methodeName, className) {
        console.error(error);
        fetch(this.apiEndpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ error: error.message, methodeName: methodeName, className: className || error, methodeName: methodeName, className: className }),
        });
    }

    showAlert(message, options = {}) {

        const defaultOptions = {
            title: 'Error',
            text: message,
            icon: 'error',
            background: '#fff',
            color: '#000',
            confirmButtonColor: '#000',
            confirmButtonText: 'OK',
            buttonsStyling: true,
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                content: 'custom-swal-content',
                confirmButton: 'custom-swal-confirm-button',
            },
            ...options, // override the default options with the provided options
        };
        Swal.fire(defaultOptions);
    }
}

export default ErrorHandler;
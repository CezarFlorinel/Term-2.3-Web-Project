import ErrorHandler from './error_handler_class.js';
const errorHandler = new ErrorHandler();
const imageSizeLimit = 10000000; // 10MB

function handleApiResponse(response) {
    return response.json().then(data => {
        if (!response.ok) {
            throw new Error(data.error || 'Network response was not ok');
        }
        if (data.error) {
            errorHandler.showAlert(data.error);
        }
        else if (data.message) {
            errorHandler.showAlert(data.message, { title: 'Success', icon: 'success' });
        }
        return data;
    });
}

function checkImageSizeAndFileType(image) {
    if (image.size > imageSizeLimit) {
        errorHandler.showAlert('The image is too large, max size is 10MB');
        return false;
    }
    else if (!image.type.includes('image')) {
        errorHandler.showAlert('The file is not an image');
        return false;
    }
    return true;
}


function checkText(texts = {}) {
    for (const key in texts) {
        if (!texts[key] || texts[key].length < 1) {
            errorHandler.showAlert('Please fill in all fields!');
            return false;
        }
    }
    return true;
}

function checkNumber(number) {
    if (isNaN(number) || number < 0 || !number) {
        errorHandler.showAlert('Please enter a valid number');
        return false;
    }
    return true;
}

function checkReviewStarNumber(numberOfStars) {
    if (isNaN(numberOfStars) || numberOfStars < 0 || numberOfStars > 5) {
        errorHandler.showAlert('Please enter a number between 0 and 5');
        return false;
    }
    return true;
}



export { handleApiResponse, checkImageSizeAndFileType, checkText, checkNumber, checkReviewStarNumber };


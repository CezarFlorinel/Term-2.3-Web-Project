import { setupImageUploadListener } from './../Reusables/update_image.js';
import { setSummerNote, setupImageUploadListeners, setupBottomEventListeners, attachClickEventToImageForInputOfImage } from './modules/set_listeners_and_editor.js';
import { updateEventInformation, updateBottomEventInformation } from './modules/update_event_information.js';
import { updateTopImage, updateHomePageDetailsTopPartInformation } from './modules/update_top_details.js';
import { updateLocationInformation } from './modules/update_location_info.js';
import { updateMobileEventInformation } from './modules/update_mobile_event_info.js';

//const api's for image uploading
const apiUpdateHomeFestivalLocationImage = '/api/homeManagement/updateHomeFestivalLocationImage';
const apiUpdateHomeGameEventDetailsImage = '/api/homeManagement/updateHomeGameEventDetailsImage';
const columnNameGameEventImageQRcode = 'ImageQRcodePath';
const columnNameGameEventImageDecoration = 'ImageDexterPath';

$(document).ready(function () {

    setSummerNote();
    updateEventInformation();

    setupImageUploadListeners();
    setupBottomEventListeners();
    setupImageUploadListener("js_imageLocationInput", apiUpdateHomeFestivalLocationImage, "js_containerLocation", "js_imageLocation");
    setupImageUploadListener("js_QrCodeImageInput", apiUpdateHomeGameEventDetailsImage, "js_containerGameEvent", "js_QrCodeImage", columnNameGameEventImageQRcode);
    setupImageUploadListener("js_DecorationImageInput", apiUpdateHomeGameEventDetailsImage, "js_containerGameEvent", "js_DecorationImage", columnNameGameEventImageDecoration);

    updateTopImage();
    updateHomePageDetailsTopPartInformation();
    attachClickEventToImageForInputOfImage()
    updateBottomEventInformation();
    updateLocationInformation();
    updateMobileEventInformation();

});


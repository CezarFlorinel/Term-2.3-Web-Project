import { handleRouteView, handleClickOutsideRouteView } from './modules_festival_page/route_view.js';
import { toggleAnswerDisplay } from './modules_festival_page/toggle_answer.js';
import { changeCellForBuyingTicketInTheTimeTable } from './modules_festival_page/change_cell_timetable.js';
import { textTospeech } from './modules_festival_page/text_to_speech.js';
import { runImageCarousel } from './modules_festival_page/image_carousel.js';

document.addEventListener('DOMContentLoaded', () => {
    handleRouteView();
    handleClickOutsideRouteView();
    toggleAnswerDisplay();
    changeCellForBuyingTicketInTheTimeTable();
    textTospeech();
    runImageCarousel();
});







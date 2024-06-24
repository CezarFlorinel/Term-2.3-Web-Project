import { setupImageUploadListener } from '../Reusables/update_image.js';
import { deleteArtist, updateArtistName } from './admin_modules/artist_individual_page/artist.js';
import { addSpotifyLink, deleteSpotifyLink } from './admin_modules/artist_individual_page/spotify_link.js';
import { addCareerHighlight, deleteCareerHighlight, updateCareerHighlight } from './admin_modules/artist_individual_page/career_highlights.js';


const imageArtistApiUrl = "/api/artistAdminManagement/updateArtistImage";
const containerForArtistImageID = "js_artistInfoIdContainer";
const imageTopColumnName = "ImageTop";
const imageArtistLineupColumnName = "ImageArtistLineupHome";
const imageCarrerHighLightUrl = "/api/artistAdminManagement/updateCareerHighlightImage";

document.addEventListener("DOMContentLoaded", () => {

    const artistId = document.getElementById('js_artistInfoIdContainer').dataset.id;

    document.getElementById('js_deleteArtistButton').addEventListener('click', function () {
        if (confirm("Are you sure you want to delete this artist?")) {
            deleteArtist(artistId);
        }
    });

    document.getElementById('js_updateArtistNameButton').addEventListener('click', function () {
        updateArtistName(artistId);
    });

    setupImageUploadListener('js_imageTopInput', imageArtistApiUrl, containerForArtistImageID, 'js_imageTop', imageTopColumnName);
    setupImageUploadListener('js_imageArstistLineupInput', imageArtistApiUrl, containerForArtistImageID, 'js_imageArstistLineup', imageArtistLineupColumnName);

    document.getElementById('js_addSpotifyLinkButton').addEventListener('click', function () {
        addSpotifyLink(artistId);
    });

    document.querySelectorAll('.js_deleteSpotifyClass').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[1];
            deleteSpotifyLink(id);
        });
    });

    document.getElementById('js_addCareerHighlightButton').addEventListener('click', function (event) {
        event.preventDefault();
        addCareerHighlight(artistId);
    });

    document.querySelectorAll('.js_deleteCareerHighlightButton').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[1];
            deleteCareerHighlight(id);
        });
    });

    document.querySelectorAll('.js_changeImageCarrerHighlightButton').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[1];
            setupImageUploadListener(`js_imageArtistCarrerInput_${id}`, imageCarrerHighLightUrl, `js_carrerHighlightContainer_${id}`, `js_imageArtistCarrerHighlight_${id}`);
        });

    });

    document.querySelectorAll('.js_updateCareerHighlightButton').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[1];
            updateCareerHighlight(id);
        });
    });
});





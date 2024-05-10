<?php

namespace App\Services;

use App\Repositories\DanceRepository;
use App\Models\Dance_event\ImageHomePage;
use App\Models\Dance_event\CareerHighlights;
use App\Models\Dance_event\Artist;
use App\Models\Dance_event\ArtistSpotifyLink;
use App\Models\Dance_event\ClubLocation;

class DanceService
{
    private $danceRepository;

    public function __construct()
    {
        $this->danceRepository = new DanceRepository();
    }

    public function getArtistById($artistID): Artist
    {
        return $this->danceRepository->getArtistById($artistID);
    }

    public function getAllArtists(): array
    {
        return $this->danceRepository->getAllArtists();
    }


    public function getArtistSpotifyLinks(int $artistID): array|null

    {
        return $this->danceRepository->getArtistSpotifyLinks($artistID);
    }

    public function getImageHomePage(): ImageHomePage
    {
        return $this->danceRepository->getImageHomePage();
    }

    public function getCareerHighlightsByArtistID($artistID): array|null

    {
        return $this->danceRepository->getCareerHighlightsByArtistID($artistID);
    }
    public function getAllClubLocations(): array
    {
        return $this->danceRepository->getAllClubLocations();
    }

    public function getClubLocationById($id): ClubLocation
    {
        return $this->danceRepository->getClubLocationById($id);
    }


    public function getCareerHighlightsById($id): CareerHighlights
    {
        return $this->danceRepository->getCareerHighlightsById($id);
    }


    public function getAllClubLocationStrings(): array
    {
        return $this->danceRepository->getAllClubLocationStrings();
    }


    public function getConcertsByArtistName($name): array
    {
        return $this->danceRepository->getConcertsByArtistName($name);
    }

    // -----------++++++++++++++ delete methods ++++++++++++++----------------

    public function deleteArtist($artistID): void
    {
        $this->danceRepository->deleteArtist($artistID);
    }

    public function deleteArtistSpotifyLinks($id): void
    {
        $this->danceRepository->deleteArtistSpotifyLinks($id);
    }
    public function deleteCareerHighlights($id): void
    {
        $this->danceRepository->deleteCareerHighlights($id);
    }
    public function deleteClubLocation($id): void
    {
        $this->danceRepository->deleteClubLocation($id);
    }
    // -----------++++++++++++++ update methods ++++++++++++++----------------

    public function updateArtistName($id, $name): void
    {
        $this->danceRepository->updateArtistName($id, $name);
    }
    public function updateImageHomePage($id, $imagePath): void
    {
        $this->danceRepository->updateImageHomePage($id, $imagePath);
    }
    public function updateClubLocation($id, $name, $location, $currentName): void
    {
        $this->danceRepository->updateClubLocation($id, $name, $location, $currentName);
    }

    public function updateClubLocationImage($id, $imagePath): void
    {
        $this->danceRepository->updateClubLocationImage($id, $imagePath);
    }


    public function updateImageArtist($id, $column, $imagePath): void
    {
        $this->danceRepository->updateImageArtist($id, $column, $imagePath);
    }

    public function updateCareerHighlights($id, $titleYearPeriod, $text): void
    {
        $this->danceRepository->updateCareerHighlights($id, $titleYearPeriod, $text);
    }

    public function updateCareerHighlightsImage($id, $imagePath): void
    {
        $this->danceRepository->updateCareerHighlightsImage($id, $imagePath);
    }


    // -----------++++++++++++++ create methods ++++++++++++++----------------

    public function addClubLocation($name, $location, $imagePath): void
    {
        $this->danceRepository->addClubLocation($name, $location, $imagePath);
    }


    public function addArtist($artistName, $imageTop, $imageArtistLineupHome): void
    {
        $this->danceRepository->addArtist($artistName, $imageTop, $imageArtistLineupHome);
    }

    public function addArtistSpotifyLink($spotifyLink, $artistID): void
    {
        $this->danceRepository->addArtistSpotifyLink($spotifyLink, $artistID);
    }

    public function addCareerHighlights($titleYearPeriod, $artistID, $text, $image): void
    {
        $this->danceRepository->addCareerHighlights($titleYearPeriod, $artistID, $text, $image);
    }

}

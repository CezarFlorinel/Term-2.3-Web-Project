<?php

namespace App\Repositories;

use PDO;
use App\Models\Dance_event\ImageHomePage;
use App\Models\Dance_event\CareerHighlights;
use App\Models\Dance_event\Artist;
use App\Models\Dance_event\ArtistSpotifyLink;
use App\Models\Dance_event\ClubLocation;
use App\Repositories\TicketsRepository;

class DanceRepository extends Repository
{
    public function getArtistById($artistID): Artist
    {
        $stmt = $this->connection->prepare('SELECT * FROM ARTIST WHERE ID = :artistID');
        $stmt->bindParam(':artistID', $artistID);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Artist(
            $results['ID'],
            $results['ArtistName'],
            $results['ImageTop'],
            $results['ImageArtistLineupHome']
        );
    }

    public function getAllArtists(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM ARTIST');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $artists = [];
        foreach ($results as $result) {
            $artists[] = new Artist(
                $result['ID'],
                $result['ArtistName'],
                $result['ImageTop'],
                $result['ImageArtistLineupHome']
            );
        }

        return $artists;
    }

    public function getArtistSpotifyLinks(int $artistID): array|null
    {
        $stmt = $this->connection->prepare('SELECT * FROM ARTIST_SPOTIFY_LINK WHERE FK_ArtistID = :artistID');
        $stmt->bindParam(':artistID', $artistID, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $artistSpotifyLinks = [];
        foreach ($results as $result) {
            $artistSpotifyLinks[] = new ArtistSpotifyLink(
                $result['ID'],
                $result['SpotifyLink'],
                $result['FK_ArtistID']
            );
        }

        return $artistSpotifyLinks;
    }

    public function getImageHomePage(): ImageHomePage
    {
        $stmt = $this->connection->prepare('SELECT * FROM IMAGE_HOME_PAGE_DANCE');
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return new ImageHomePage(
            $results['ID'],
            $results['ImagePath']
        );
    }

    public function getCareerHighlightsByArtistID($artistID): array|null
    {
        $stmt = $this->connection->prepare('SELECT * FROM CAREER_HIGHLIGHTS WHERE FK_ArtistID = :artistID');
        $stmt->bindParam(':artistID', $artistID);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $careerHighlights = [];
        foreach ($results as $result) {
            $careerHighlights[] = new CareerHighlights(
                $result['ID'],
                $result['TitleYearPeriod'],
                $result['FK_ArtistID'],
                $result['Text'],
                $result['Image']
            );
        }

        return $careerHighlights;
    }

    public function getAllClubLocations(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM CLUB_LOCATION');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clubLocations = [];
        foreach ($results as $result) {
            $clubLocations[] = new ClubLocation(
                $result['ID'],
                $result['Name'],
                $result['Location'],
                $result['ImagePathLocation']
            );
        }

        return $clubLocations;
    }

    public function getAllClubLocationStrings(): array
    {
        $stmt = $this->connection->prepare('SELECT Name FROM CLUB_LOCATION');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clubLocationStrings = [];
        foreach ($results as $result) {
            $clubLocationStrings[] = $result['Name'];
        }

        return $clubLocationStrings;
    }

    public function getClubLocationById($id): ClubLocation
    {
        $stmt = $this->connection->prepare('SELECT * FROM CLUB_LOCATION WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return new ClubLocation(
            $results['ID'],
            $results['Name'],
            $results['Location'],
            $results['ImagePathLocation']
        );
    }

    public function getCareerHighlightsById($id): CareerHighlights
    {
        $stmt = $this->connection->prepare('SELECT * FROM CAREER_HIGHLIGHTS WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return new CareerHighlights(
            $results['ID'],
            $results['TitleYearPeriod'],
            $results['FK_ArtistID'],
            $results['Text'],
            $results['Image']
        );
    }

    // -----------++++++++++++++ delete methods ++++++++++++++----------------

    public function deleteArtist($artistID): void
    {
        $stmt = $this->connection->prepare('DELETE FROM ARTIST WHERE ID = :artistID');
        $stmt->bindParam(':artistID', $artistID);
        $stmt->execute();
    }

    public function deleteArtistSpotifyLinks($id): void
    {
        $stmt = $this->connection->prepare('DELETE FROM ARTIST_SPOTIFY_LINK WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteCareerHighlights($id): void
    {
        $stmt = $this->connection->prepare('DELETE FROM CAREER_HIGHLIGHTS WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteClubLocation($id): void
    {
        $stmt = $this->connection->prepare('DELETE FROM CLUB_LOCATION WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // -----------++++++++++++++ update methods ++++++++++++++----------------

    public function updateArtistName($id, $name): void
    {
        $stmt = $this->connection->prepare('UPDATE ARTIST SET ArtistName = :artistName WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':artistName', $name);
        $stmt->execute();
    }

    public function updateImageArtist($id, $column, $imagePath): void
    {
        $stmt = $this->connection->prepare('UPDATE ARTIST SET ' . $column . ' = :imagePath WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->execute();

    }

    public function updateCareerHighlights($id, $titleYearPeriod, $text): void
    {
        $stmt = $this->connection->prepare('UPDATE CAREER_HIGHLIGHTS SET TitleYearPeriod = :titleYearPeriod, Text = :text WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titleYearPeriod', $titleYearPeriod);
        $stmt->bindParam(':text', $text);
        $stmt->execute();
    }

    public function updateCareerHighlightsImage($id, $imagePath): void
    {
        $stmt = $this->connection->prepare('UPDATE CAREER_HIGHLIGHTS SET Image = :imagePath WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->execute();
    }

    public function updateImageHomePage($id, $imagePath): void
    {
        $stmt = $this->connection->prepare('UPDATE IMAGE_HOME_PAGE_DANCE SET ImagePath = :imagePath WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->execute();
    }

    public function updateClubLocation($id, $name, $location, $currentName, ): void
    {
        $ticketRepo = new TicketsRepository();
        $ticketRepo->changeTicketDanceLocationName($name, $currentName);

        $stmt = $this->connection->prepare('UPDATE CLUB_LOCATION SET Name = :name, Location = :location WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':location', $location);
        $stmt->execute();
    }

    public function updateClubLocationImage($id, $imagePath): void
    {
        $stmt = $this->connection->prepare('UPDATE CLUB_LOCATION SET ImagePathLocation = :imagePath WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->execute();
    }


    // -----------++++++++++++++ create methods ++++++++++++++----------------

    public function addClubLocation($name, $location, $imagePath): void
    {
        $stmt = $this->connection->prepare('INSERT INTO CLUB_LOCATION (Name, Location, ImagePathLocation) VALUES (:name, :location, :imagePath)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->execute();
    }

    public function addArtist($artistName, $imageTop, $imageArtistLineupHome): void
    {
        $stmt = $this->connection->prepare('INSERT INTO ARTIST (ArtistName, ImageTop, ImageArtistLineupHome) VALUES (:artistName, :imageTop, :imageArtistLineupHome)');
        $stmt->bindParam(':artistName', $artistName);
        $stmt->bindParam(':imageTop', $imageTop);
        $stmt->bindParam(':imageArtistLineupHome', $imageArtistLineupHome);
        $stmt->execute();
    }

    public function addArtistSpotifyLink($spotifyLink, $artistID): void
    {
        $stmt = $this->connection->prepare('INSERT INTO ARTIST_SPOTIFY_LINK (SpotifyLink, FK_ArtistID) VALUES (:spotifyLink, :artistID)');
        $stmt->bindParam(':spotifyLink', $spotifyLink);
        $stmt->bindParam(':artistID', $artistID);
        $stmt->execute();
    }

    public function addCareerHighlights($titleYearPeriod, $artistID, $text, $image): void
    {
        $stmt = $this->connection->prepare('INSERT INTO CAREER_HIGHLIGHTS (TitleYearPeriod, FK_ArtistID, Text, Image) VALUES (:titleYearPeriod, :artistID, :text, :image)');
        $stmt->bindParam(':titleYearPeriod', $titleYearPeriod);
        $stmt->bindParam(':artistID', $artistID);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':image', $image);
        $stmt->execute();
    }


}




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

    public function getArtistSpotifyLinks($artistID): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM ARTIST_SPOTIFY_LINK WHERE ArtistID = :artistID');
        $stmt->bindParam(':artistID', $artistID);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $artistSpotifyLinks = [];
        foreach ($results as $result) {
            $artistSpotifyLinks[] = new ArtistSpotifyLink(
                $result['ID'],
                $result['FK_ArtistID'],
                $result['SpotifyLink']
            );
        }

        return $artistSpotifyLinks;
    }

    public function getImageHomePage(): ImageHomePage
    {
        $stmt = $this->connection->prepare('SELECT * FROM IMAGE_HOME_PAGE');
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return new ImageHomePage(
            $results['ID'],
            $results['ImagePath']
        );
    }

    public function getCareerHighlightsByArtistID($artistID): CareerHighlights
    {
        $stmt = $this->connection->prepare('SELECT * FROM CAREER_HIGHLIGHTS WHERE FK_ArtistID = :artistID');
        $stmt->bindParam(':artistID', $artistID);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return new CareerHighlights(
            $results['ID'],
            $results['FK_ArtistID'],
            $results['TitleYearPeriod'],
            $results['Text'],
            $results['Image']
        );
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
                $result['Location']
            );
        }

        return $clubLocations;
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

    public function updateArtist($artist): void
    {
        $stmt = $this->connection->prepare('UPDATE ARTIST SET ArtistName = :artistName, ImageTop = :imageTop, ImageArtistLineupHome = :imageArtistLineupHome WHERE ID = :id');
        $stmt->bindParam(':id', $artist->getId());
        $stmt->bindParam(':artistName', $artist->getArtistName());
        $stmt->bindParam(':imageTop', $artist->getImageTop());
        $stmt->bindParam(':imageArtistLineupHome', $artist->getImageArtistLineupHome());
        $stmt->execute();
    }

    public function updateImageHomePage($id): void
    {
        $stmt = $this->connection->prepare('UPDATE IMAGE_HOME_PAGE SET ImagePath = :imagePath WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }


    // -----------++++++++++++++ create methods ++++++++++++++----------------


}




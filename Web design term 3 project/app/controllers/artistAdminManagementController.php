<?php
namespace App\Controllers;

class ArtistAdminManagementController
{
    public function index()
    {
        require __DIR__ . '/../views/administrator_control_pages/dance/editArtist.php';
    }
}
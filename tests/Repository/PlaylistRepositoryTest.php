<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Repository;

use App\Entity\Playlist;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
/**
 * Description of PlaylistRepositoryTest
 *
 * @author Mathis
 */
class PlaylistRepositoryTest extends KernelTestCase{
    
    public function recupRepository(): PlaylistRepository
    {
        self::bootKernel();
        $repository = self::getContainer()->get(PlaylistRepository::class);
        return $repository;
    }
    
    public function testNbPlaylists(){
        $repository = $this->recupRepository();
        $nbPlaylists = $repository->count([]);
        $this->assertEquals(29, $nbPlaylists);
    }
    
    public function newPlaylist(): Playlist
    {
        $playlist = (new Playlist())
                ->setName("Test");
        return $playlist; 
    }
    
    public function testAdd()
    {
        $repository = $this->recupRepository();
        $playlist = $this->newPlaylist();
        $nbPlaylists = $repository->count([]);
        $repository->add($playlist, true);
        $this->assertEquals($nbPlaylists + 1, $repository->count([]), "erreur lors de l'ajout");
    }
    
    public function testFindAllWithFormationCount()
    {
        $repository = $this->recupRepository();

        // Tester avec tri ascendant
        $playlistsAsc = $repository->findAllWithFormationCount('ASC');
        $this->assertNotEmpty($playlistsAsc, "La liste des playlists (ASC) est vide.");

        for ($i = 0; $i < count($playlistsAsc) - 1; $i++) {
            $this->assertLessThanOrEqual(
                $playlistsAsc[$i + 1]->getNbFormations(),
                $playlistsAsc[$i]->getNbFormations(),
                "Les playlists ne sont pas triées par nombre de formations croissant."
            );
        }

        // Tester avec tri descendant
        $playlistsDesc = $repository->findAllWithFormationCount('DESC');
        $this->assertNotEmpty($playlistsDesc, "La liste des playlists (DESC) est vide.");

        for ($i = 0; $i < count($playlistsDesc) - 1; $i++) {
            $this->assertGreaterThanOrEqual(
                $playlistsDesc[$i + 1]->getNbFormations(),
                $playlistsDesc[$i]->getNbFormations(),
                "Les playlists ne sont pas triées par nombre de formations décroissant."
            );
        }
}

}

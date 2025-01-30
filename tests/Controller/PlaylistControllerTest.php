<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of PlaylistControllerTest
 *
 * @author Mathis
 */
class PlaylistControllerTest extends WebTestCase{
    
    public function testTrisFiltresPage(){
        $client = static::createClient();
        $client->request('GET', '/playlists');
        $this->assertSelectorTextContains('h5', 'Bases de la programmation (C#)');
    }
    
    public function testButtonAdd(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/playlists');
        $link = $crawler->selectLink('Ajouter')->link();
        $client->click($link);
        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $uri = $client->getRequest()->server->get("REQUEST_URI");
        $this->assertEquals('/playlists/form', $uri);
    }
    
    public function testFiltresPage(){
        $client = static::createClient();
        $client->request('GET', '/playlists');
        $crawler = $client->submitForm('filtrer', [
            'recherche' => 'Bases de la programmation (C#)'
        ]);
        $this->assertCount(1, $crawler->filter('h5'));
        $this->assertSelectorTextContains('h5', 'Bases de la programmation (C#)');
    }
}

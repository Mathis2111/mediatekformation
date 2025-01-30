<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of FormationControllerTest
 *
 * @author Mathis
 */
class FormationControllerTest extends WebTestCase{
    
    public function testTrisPage(){
        $client = static::createClient();
        $client->request('GET', '/formations');
        $this->assertSelectorTextContains('h5', 'Eclipse n°8 : Déploiement');
    }
    
    public function testButtonAdd(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/formations');
        $link = $crawler->selectLink('Ajouter')->link();
        $client->click($link);
        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $uri = $client->getRequest()->server->get("REQUEST_URI");
        $this->assertEquals('/formations/form', $uri);
    }
    
    public function testFiltresPage(){
        $client = static::createClient();
        $client->request('GET', '/formations');
        $crawler = $client->submitForm('filtrer', [
            'recherche' => 'Eclipse n°8 : Déploiement'
        ]);
        $this->assertCount(1, $crawler->filter('h5'));
        $this->assertSelectorTextContains('h5', 'Eclipse n°8 : Déploiement');
    }
}

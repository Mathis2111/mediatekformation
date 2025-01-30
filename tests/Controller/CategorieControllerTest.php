<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of CategorieControllerTest
 *
 * @author Mathis
 */
class CategorieControllerTest extends WebTestCase{
    
    public function testTrisFiltresPage(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/categories');
        $this->assertSelectorTextContains('h5', 'Java');
    }
    
    public function testButtonAdd(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/categories');
        $link = $crawler->selectLink('Ajouter')->link();
        $client->click($link);
        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $uri = $client->getRequest()->server->get("REQUEST_URI");
        $this->assertEquals('/categories/form', $uri);
    }
}

<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Repository;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
/**
 * Description of CategorieRepositoryTest
 *
 * @author Mathis
 */
class CategorieRepositoryTest extends KernelTestCase{

    public function recupRepository(): CategorieRepository
    {
        self::bootKernel();
        $repository = self::getContainer()->get(CategorieRepository::class);
        return $repository;
    }

    public function testNbCategories(){
        $repository = $this->recupRepository();
        $nbCategories = $repository->count([]);
        $this->assertEquals(10, $nbCategories);
    }
    
    public function newCategorie(): Categorie
    {
        $categorie = (new Categorie())
                ->setName("Cours");
        return $categorie; 
    }

    public function testAdd()
    {
        $repository = $this->recupRepository();
        $categorie = $this->newCategorie();
        $nbCategories = $repository->count([]);
        $repository->add($categorie, true);
        $this->assertEquals($nbCategories + 1, $repository->count([]), "erreur lors de l'ajout");
    }
    
}

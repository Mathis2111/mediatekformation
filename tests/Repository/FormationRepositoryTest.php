<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Repository;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
/**
 * Description of FormationRepositoryTest
 *
 * @author Mathis
 */
class FormationRepositoryTest extends KernelTestCase{
    
    public function recupRepository(): FormationRepository
    {
        self::bootKernel();
        $repository = self::getContainer()->get(FormationRepository::class);
        return $repository;
    }
    
    public function testNbFormations(){
        $repository = $this->recupRepository();
        $nbFormations = $repository->count([]);
        $this->assertEquals(236, $nbFormations);
    }
    
    public function newFormation(): Formation
    {
        $formation = (new Formation())
                ->setTitle("Test");
        return $formation; 
    }
    
    public function testAdd()
    {
        $repository = $this->recupRepository();
        $formation = $this->newFormation();
        $nbFormations = $repository->count([]);
        $repository->add($formation, true);
        $this->assertEquals($nbFormations + 1, $repository->count([]), "erreur lors de l'ajout");
    }
}

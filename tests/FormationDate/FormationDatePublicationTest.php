<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\FormationDate;

use App\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;
/**
 * Description of FormationDatePublicationTest
 *
 * @author Mathis
 */
class FormationDatePublicationTest extends KernelTestCase{
    
    public function getFormation(): Formation{
        return (new Formation())
                -> setTitle("Test")
                ->setPublishedAt(new \DateTime("2025-01-24"));
    }
    
    public function testPublishedAt(){
        $formation = $this->getFormation()->setPublishedAt(new \DateTime("2025-01-24"));
        $this->assertErrors($formation, 0);
    }
    
    public function assertErrors (Formation $formation, int $nbErreurAttendues){
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($formation);
        $this->assertCount($nbErreurAttendues, $error);
    }
    
    public function testNonValidDatePublication(){
        $formation = $this->getFormation()->setPublishedAt(new \DateTime("2025-01-26"));
        $this->assertErrors($formation, 1);       
    }
    
}

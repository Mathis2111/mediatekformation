<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Formation;
/**
 * Description of FormationTest
 *
 * @author Mathis
 */
class FormationTest extends TestCase{
    
    public function testPublishedAtString()
    {
        $formation = new Formation();

        $date = new \DateTime('2025-01-20');
        $formation->setPublishedAt($date);
        $expectedDateString = $date->format('d/m/Y');
        $this->assertEquals(
            $expectedDateString,
            $formation->getPublishedAtString(),
            "La date formatée ne correspond pas à la date attendue."
        );

        $formation->setPublishedAt(null);
        $this->assertEquals(
            "",
            $formation->getPublishedAtString(),
            "La chaîne retournée ne correspond pas à une chaîne vide lorsque la date est nulle."
        );
    }
}

<?php
namespace Alexandre\Gesuas\Tests;

use PHPUnit\Framework\TestCase;
use Alexandre\Gesuas\Model\Citizen;

class CitizenTest extends TestCase
{
    public function testValidCitizen()
    {
        $citizen = new Citizen(null, 'Maria Silva', '12345678901');
        $this->assertEquals('Maria Silva', $citizen->name);
    }

    public function testInvalidNameThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Citizen(null, 'A1', '12345678901'); // Nome com número
    }

    public function testEmptyNameThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Citizen(null, '', '12345678901');
    }
}
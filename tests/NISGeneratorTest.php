<?php
namespace Alexandre\Gesuas\Tests;

use PHPUnit\Framework\TestCase;
use Alexandre\Gesuas\Model\NISGenerator;

class NISGeneratorTest extends TestCase
{
    public function testGenerateReturnsValidNIS()
    {
        $nis = NISGenerator::generate();
        
        // Verifica se tem 11 dígitos
        $this->assertMatchesRegularExpression('/^\d{11}$/', $nis);
        
        // Verifica o dígito verificador
        $base = substr($nis, 0, 10);
        $dv = substr($nis, -1);
        $this->assertEquals(NISGenerator::calculateCheckDigit($base), $dv);
    }

    public function testCalculateCheckDigit()
    {
        $this->assertEquals(0, NISGenerator::calculateCheckDigit('1234567890'));
        $this->assertEquals(6, NISGenerator::calculateCheckDigit('1111111111'));
    }
}
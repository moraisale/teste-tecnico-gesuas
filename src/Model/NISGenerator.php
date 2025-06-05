<?php
namespace Alexandre\Gesuas\Model;

class NISGenerator {
    // Gera um número de 11 dígitos com digito verificador
    public static function generate(): string {
        $base = str_pad(mt_rand(0, 999999999), 10, '0', STR_PAD_LEFT);
        $dv = self::calculateCheckDigit($base);
        return $base . $dv; 
    }

    // Cálculo do Dígito Verificador 
    public static function calculateCheckDigit(string $base): int {
        $pesos = [3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        
        for ($i = 0; $i < 10; $i++) {
            $soma += $base[$i] * $pesos[$i];
        }
        
        $resto = $soma % 11;
        return ($resto < 2) ? 0 : 11 - $resto;
    }
}
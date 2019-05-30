<?php

namespace App\Enum;

abstract class EscolaridadeEnum
{
    const EFI     = 1;
    const EFC     = 2;
    const EMI     = 3;
    const EMC     = 4;
    const ESI     = 5;
    const ESC     = 6;    

    public static function getEscolaridade()
    {
        return [
            self::EFI  => 'Ensino Fundamental Incompleto',
            self::EFC  => 'Ensino Fundamental Completo',
            self::EMI  => 'Ensino Médio Incompleto',
            self::EMC  => 'Ensino Médio Completo',
            self::ESI  => 'Ensino Superior Incompleto',
            self::ESC  => 'Ensino Superior Completo',
        ];
    }

}
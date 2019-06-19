<?php

namespace App\Enum;

abstract class TipoDocumentoEnum
{
    const CI        = 1;
    const OFICIO    = 2;
    const RELATORIO = 3;
    const PROCESSO  = 4;
    const OUTROS    = 5;

    public static function getTipo()
    {
        return [
            self::CI        => 'C.I.',
            self::OFICIO    => 'Ofício',
            self::RELATORIO => 'Relatório',
            self::PROCESSO  => 'Processo',
            self::OUTROS    => 'Outros',
        ];
    }

}
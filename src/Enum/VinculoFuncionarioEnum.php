<?php

namespace App\Enum;

abstract class VinculoFuncionarioEnum
{
    const EFETIVO          = 1;
    const COMISSIONADO     = 2;
    const TEMPORARIO       = 3;
    const AGENTE_POLITICO  = 4;
    const ESTAGIARIO       = 5;
    const TERCEIRIZADO     = 6;

    public static function getVinculos()
    {
        return [
            self::EFETIVO          => 'Efetivo',
            self::COMISSIONADO   => 'Comissionado',
            self::TEMPORARIO     => 'Temporário',
            self::AGENTE_POLITICO  => 'Agente Político',
            self::ESTAGIARIO  => 'Estagiário',
            self::TERCEIRIZADO => 'Terceirizado'
        ];
    }
}

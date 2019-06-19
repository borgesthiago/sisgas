<?php

namespace App\Enum;

abstract class RolesEnum
{
    const ROLE_SUPER_ADMIN  = 'ROLE_SUPER_ADMIN';
    const ROLE_ADMIN        = 'ROLE_ADMIN';
    const ROLE_TECNICO      = 'ROLE_TECNICO';
    const ROLE_CONSULTA     = 'ROLE_CONSULTA';

    public static function getRoles()
    {
        return [
            'Consulta'      => self::ROLE_CONSULTA,
            'Técnico'       => self::ROLE_TECNICO,
            'Administrador' => self::ROLE_ADMIN,
            'Secretário(a)'   => self::ROLE_SUPER_ADMIN,
        ];
    }
}
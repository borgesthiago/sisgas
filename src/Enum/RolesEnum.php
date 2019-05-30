<?php

namespace App\Enum;

abstract class RolesEnum
{
    const ROLE_SUPER_ADMIN  = 'ROLE_SUPER_ADMIN';
    const ROLE_ADMIN        = 'ROLE_ADMIN';
    const ROLE_DIRETOR      = 'ROLE_DIRETOR';
    const ROLE_CONSULTA     = 'ROLE_CONSULTA';

    public static function getRoles()
    {
        return [
            'Consulta'       => self::ROLE_CONSULTA,
            'Diretor' => self::ROLE_DIRETOR,
            'Administrador'       => self::ROLE_ADMIN,
            'Super Admin'   => self::ROLE_SUPER_ADMIN,
        ];
    }
}
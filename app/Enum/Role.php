<?php

namespace App\Enum;

enum Role: string
{
    case ADMIN = 'admin';
    case TEACHER = 'teacher';
    case STUDENT = 'student';

    public static function getIndonesianRole(string $role): string {
        return match(Role::from($role)) {
            self::TEACHER => 'guru',
            self::STUDENT => 'murid',
            self::ADMIN => 'admin',
        };
    }
}

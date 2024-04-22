<?php

namespace App\Enum;

enum Role: string
{
    case TEACHER = 'teacher';
    case STUDENT = 'student';

    public static function getIndonesianRole(string $role): string {
        return match(Role::from($role)) {
            self::TEACHER => 'guru',
            self::STUDENT => 'murid',
        };
    }
}

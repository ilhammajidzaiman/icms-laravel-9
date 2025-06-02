<?php

namespace App\Enums;

enum RoleEnum: string
{
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';

    public function label(): ?string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::Admin => 'Admin',
        };
    }

    public function color(): string|array|null
    {
        return match ($this) {
            self::SuperAdmin => 'primary',
            self::Admin => 'success',
        };
    }

    public function icon(): ?string
    {
        return match ($this) {
            self::SuperAdmin => 'heroicon-o-danger',
            self::Admin => 'heroicon-o-danger',
        };
    }
}

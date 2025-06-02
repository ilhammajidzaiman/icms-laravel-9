<?php

namespace App\Enums;

enum GenderEnum: string
{
    case LakiLaki = 'male';
    case Perempuan = 'female';

    public function label(): ?string
    {
        return match ($this) {
            self::LakiLaki => 'Laki-laki',
            self::Perempuan => 'Perempuan',
        };
    }
}

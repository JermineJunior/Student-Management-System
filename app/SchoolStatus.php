<?php

namespace App;

enum SchoolStatus: int
{
    case ACTIVE = 1;
    case IN_ACTIVE = 0;


    public function label(): string
    {
        return match($this){
            self::ACTIVE => 'Active',
            self::IN_ACTIVE => 'Not Active',
        };
    }
}


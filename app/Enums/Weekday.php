<?php

namespace App\Enums;

enum Weekday: int {
    case Monday = 0;
    case Tuesday = 1;
    case Wednesday = 2;
    case Thursday = 3;
    case Friday = 4;
    case Saturday = 5;
    case Sunday = 6;

    public static function convert(String $text){
        return match($text){
            'monday' => Weekday::Monday,
            'tuesday' => Weekday::Tuesday,
            'wednesday' => Weekday::Wednesday,
            'thursday' => Weekday::Thursday,
            'friday' => Weekday::Friday,
            'saturday' => Weekday::Monday,
            'sunday' => Weekday::Sunday,
        };
    }
}


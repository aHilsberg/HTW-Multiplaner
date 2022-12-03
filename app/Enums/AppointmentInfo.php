<?php

namespace App\Enums;

enum AppointmentInfo : int {
    case None = 0;
    case Lecture = 1;
    case Practical = 2;
    case Exercise = 4;

    case Online = 128;
}

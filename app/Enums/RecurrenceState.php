<?php
namespace App\Enums;

enum RecurrenceState : int {
    case None = 0;
    case Weekly = 1;
    case Biweekly = 2;
    case Monthly = 3;
}

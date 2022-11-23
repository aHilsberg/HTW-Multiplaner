<?php
namespace App\Enums;

enum FriendStatus: int {
    case FirstRequested = 0;
    case SecondRequested = 1;
    case Befriended = 2;
}

<?php
namespace App\Enums;

enum VoteStatus : int {
    case Approve = 0;
    case Oppose = 1;
}

<?php

namespace App\Exceptions;

use Exception;

class PrevalidationPassedException extends Exception
{
    public function report()
    {
        return true;
    }

    public function render()
    {
        return redirect()->back();
    }
}

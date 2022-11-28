<?php

namespace App\Exceptions;

use Exception;

class ShellCommandFailedException extends Exception {
    public function report() {
        return true;
    }

    public function render() {
        return $this->message;
    }
}

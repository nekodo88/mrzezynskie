<?php

namespace AgeGate\Integration\Sub;

use AgeGate\Common\Integration;

class Blah extends Integration
{
    public function exists()
    {
        return true;
    }

    public function init()
    {
        if ($this->exists()) {
            // dd('init blah Integration');
        }
    }
}

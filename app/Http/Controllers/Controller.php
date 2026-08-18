<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function pythonApiPath(string $path = ''): string
    {
        return base_path('../python-api/' . ltrim($path, '/'));
    }
}

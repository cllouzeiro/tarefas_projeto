<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Sanitize extends Controller
{
    static function sanitizeNome($nome)
    {
        return preg_replace('/[^A-ZÀ-Úà-ùa-z] /', '', $nome);
    }

    static function sanitizeCpf($cpf)
    {
        return preg_replace('/[^0-9]/', '', $cpf);
    }
}

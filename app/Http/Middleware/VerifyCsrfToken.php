<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/login/',
        '/login2/',
        '/nacimiento/registrar/',
        '/nacimiento/imprimir/',
        '/defuncion/registrar/',
        '/defuncion/imprimir/',
        '/matrimonio/imprimir/',
        '/matrimonio/registrar/',
        '/divorcio/registrar/',
        '/divorcio/imprimir/',
        '/municipio/lista/',
        '/departamento/lista/',
        '/dpi/consultar/',
        '/dpi/actualizar/'

    ];
}

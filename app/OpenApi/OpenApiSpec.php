<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Overskull API',
    description: 'API REST para la gestión de productos y categorías.'
)]
#[OA\Server(
    url: '/api',
    description: 'Servidor local'
)]
class OpenApiSpec
{
}
<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Categories',
    description: 'Gestión de categorías'
)]
#[OA\Get(
    path: '/categories',
    tags: ['Categories'],
    summary: 'Listar categorías',
    responses: [
        new OA\Response(response: 200, description: 'Categorías obtenidas correctamente')
    ]
)]
#[OA\Post(
    path: '/categories',
    tags: ['Categories'],
    summary: 'Crear categoría',
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['name'],
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Ropa')
            ]
        )
    ),
    responses: [
        new OA\Response(response: 201, description: 'Categoría creada correctamente'),
        new OA\Response(response: 422, description: 'Datos inválidos')
    ]
)]
#[OA\Get(
    path: '/categories/{id}',
    tags: ['Categories'],
    summary: 'Obtener categoría',
    parameters: [
        new OA\Parameter(
            name: 'id',
            description: 'ID de la categoría',
            in: 'path',
            required: true,
            schema: new OA\Schema(type: 'integer')
        )
    ],
    responses: [
        new OA\Response(response: 200, description: 'Categoría obtenida correctamente'),
        new OA\Response(response: 404, description: 'Categoría no encontrada')
    ]
)]
#[OA\Put(
    path: '/categories/{id}',
    tags: ['Categories'],
    summary: 'Actualizar categoría',
    parameters: [
        new OA\Parameter(
            name: 'id',
            description: 'ID de la categoría',
            in: 'path',
            required: true,
            schema: new OA\Schema(type: 'integer')
        )
    ],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['name'],
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Ropa Premium')
            ]
        )
    ),
    responses: [
        new OA\Response(response: 200, description: 'Categoría actualizada correctamente'),
        new OA\Response(response: 404, description: 'Categoría no encontrada'),
        new OA\Response(response: 422, description: 'Datos inválidos')
    ]
)]
#[OA\Delete(
    path: '/categories/{id}',
    tags: ['Categories'],
    summary: 'Eliminar categoría',
    parameters: [
        new OA\Parameter(
            name: 'id',
            description: 'ID de la categoría',
            in: 'path',
            required: true,
            schema: new OA\Schema(type: 'integer')
        )
    ],
    responses: [
        new OA\Response(response: 200, description: 'Categoría eliminada correctamente'),
        new OA\Response(response: 404, description: 'Categoría no encontrada')
    ]
)]
class CategoryDocumentation
{
}
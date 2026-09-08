<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Products',
    description: 'Gestión de productos'
)]
#[OA\Get(
    path: '/products',
    tags: ['Products'],
    summary: 'Listar productos',
    responses: [
        new OA\Response(
            response: 200,
            description: 'Productos obtenidos correctamente'
        )
    ]
)]
#[OA\Post(
    path: '/products',
    tags: ['Products'],
    summary: 'Crear producto',
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['name', 'price', 'stock', 'category_id'],
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Camiseta Overskull'),
                new OA\Property(property: 'description', type: 'string', example: 'Camiseta negra'),
                new OA\Property(property: 'price', type: 'number', format: 'float', example: 89.90),
                new OA\Property(property: 'stock', type: 'integer', example: 50),
                new OA\Property(property: 'category_id', type: 'integer', example: 1),
            ]
        )
    ),
    responses: [
        new OA\Response(
            response: 201,
            description: 'Producto creado correctamente'
        ),
        new OA\Response(
            response: 422,
            description: 'Datos inválidos'
        )
    ]
)]
#[OA\Get(
    path: '/products/{id}',
    tags: ['Products'],
    summary: 'Obtener producto',
    parameters: [
        new OA\Parameter(
            name: 'id',
            description: 'ID del producto',
            in: 'path',
            required: true,
            schema: new OA\Schema(type: 'integer')
        )
    ],
    responses: [
        new OA\Response(response: 200, description: 'Producto obtenido correctamente'),
        new OA\Response(response: 404, description: 'Producto no encontrado')
    ]
)]
#[OA\Put(
    path: '/products/{id}',
    tags: ['Products'],
    summary: 'Actualizar producto',
    parameters: [
        new OA\Parameter(
            name: 'id',
            description: 'ID del producto',
            in: 'path',
            required: true,
            schema: new OA\Schema(type: 'integer')
        )
    ],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Camiseta Overskull Premium'),
                new OA\Property(property: 'description', type: 'string', example: 'Camiseta actualizada'),
                new OA\Property(property: 'price', type: 'number', format: 'float', example: 149.90),
                new OA\Property(property: 'stock', type: 'integer', example: 20),
                new OA\Property(property: 'category_id', type: 'integer', example: 1),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 200, description: 'Producto actualizado correctamente'),
        new OA\Response(response: 404, description: 'Producto no encontrado'),
        new OA\Response(response: 422, description: 'Datos inválidos')
    ]
)]
#[OA\Delete(
    path: '/products/{id}',
    tags: ['Products'],
    summary: 'Eliminar producto',
    parameters: [
        new OA\Parameter(
            name: 'id',
            description: 'ID del producto',
            in: 'path',
            required: true,
            schema: new OA\Schema(type: 'integer')
        )
    ],
    responses: [
        new OA\Response(response: 200, description: 'Producto eliminado correctamente'),
        new OA\Response(response: 404, description: 'Producto no encontrado')
    ]
)]
class ProductDocumentation
{
}
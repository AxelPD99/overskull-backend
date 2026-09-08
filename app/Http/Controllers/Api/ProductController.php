<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Productos obtenidos correctamente.',
            'data' => ProductResource::collection($products),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        $product->logActivity(
            'create',
            null,
            $product->toArray()
        );

        $product->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Producto creado correctamente.',
            'data' => new ProductResource($product),
        ], 201);
    }

    public function show(Product $product)
    {
        $product->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Producto obtenido correctamente.',
            'data' => new ProductResource($product),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $oldValues = $product->toArray();

        $product->update($request->validated());

        $product->logActivity(
            'update',
            $oldValues,
            $product->fresh()->toArray()
        );

        $product->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado correctamente.',
            'data' => new ProductResource($product),
        ]);
    }

    public function destroy(Product $product)
    {
        $oldValues = $product->toArray();

        $product->logActivity(
            'delete',
            $oldValues,
            null
        );

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado correctamente.',
            'data' => null,
        ]);
    }
}
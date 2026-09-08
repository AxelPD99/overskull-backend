<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return response()->json([
            'success' => true,
            'message' => 'Categorías obtenidas correctamente.',
            'data' => CategoryResource::collection($categories),
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        $category->logActivity(
            'create',
            null,
            $category->toArray()
        );

        return response()->json([
            'success' => true,
            'message' => 'Categoría creada correctamente.',
            'data' => new CategoryResource($category),
        ], 201);
    }

    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'message' => 'Categoría obtenida correctamente.',
            'data' => new CategoryResource($category),
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $oldValues = $category->toArray();

        $category->update($request->validated());

        $category->logActivity(
            'update',
            $oldValues,
            $category->fresh()->toArray()
        );

        return response()->json([
            'success' => true,
            'message' => 'Categoría actualizada correctamente.',
            'data' => new CategoryResource($category->fresh()),
        ]);
    }

    public function destroy(Category $category)
    {
        $oldValues = $category->toArray();

        $category->delete();

        $category->logActivity(
            'delete',
            $oldValues,
            null
        );

        return response()->json([
            'success' => true,
            'message' => 'Categoría eliminada correctamente.',
            'data' => null,
        ]);
    }
}
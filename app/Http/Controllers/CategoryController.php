<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    function list(): JsonResponse
    {
        return response()->json(Category::query()->with(['parent', 'children'])->get());
    }

    function get(string $id): JsonResponse
    {
        return response()->json(Category::query()->with(['parent', 'children'])->findOrFail($id));
    }

    function create(CreateCategoryRequest $request): JsonResponse
    {
        $item = new Category();
        $item->name = $request->get('name');
        $item->parent_id = $request->get('parent_id');
        $item->save();
        return response()->json(['id' => $item->id]);
    }

    function update(string $id, CreateCategoryRequest $request): JsonResponse
    {
        $item = Category::query()->findOrFail($id);
        $item->name = $request->get('name');
        $item->parent_id = $request->get('parent_id');
        $item->save();
        return response()->json(['id' => $item->id]);
    }

    function delete(string $id): JsonResponse
    {
        $item = Category::query()->findOrFail($id);
        $item->delete();
        return response()->json();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    function list(): JsonResponse
    {
        return response()->json(Product::query()->with(['category.parent'])->get());
    }

    function get(string $id): JsonResponse
    {
        return response()->json(Product::query()->with(['category.parent'])->findOrFail($id));
    }

    function create(CreateProductRequest $request): JsonResponse
    {
        $item = new Product();
        $item->name = $request->get('name');
        $item->category_id = $request->get('category_id');
        $item->save();
        return response()->json(['id' => $item->id]);
    }

    function update(string $id, CreateProductRequest $request): JsonResponse
    {
        $item = Product::query()->findOrFail($id);
        $item->name = $request->get('name');
        $item->category_id = $request->get('category_id');
        $item->save();
        return response()->json(['id' => $item->id]);
    }

    function delete(string $id): JsonResponse
    {
        $item = Product::query()->findOrFail($id);
        $item->delete();
        return response()->json();
    }
}

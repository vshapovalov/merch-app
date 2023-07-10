<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMarketRequest;
use App\Models\Market;
use Illuminate\Http\JsonResponse;

class MarketController extends Controller
{
    function list(): JsonResponse
    {
        return response()->json(Market::query()->get());
    }

    function get(string $id): JsonResponse
    {
        return response()->json(Market::query()->findOrFail($id));
    }

    function create(CreateMarketRequest $request): JsonResponse
    {
        $item = new Market();
        $item->name = $request->get('name');
        $item->company_id = $request->get('company_id');
        $item->save();
        return response()->json(['id' => $item->id]);
    }

    function update(string $id, CreateMarketRequest $request): JsonResponse
    {
        $item = Market::query()->findOrFail($id);
        $item->name = $request->get('name');
        $item->company_id = $request->get('company_id');
        $item->save();
        return response()->json(['id' => $item->id]);
    }

    function delete(string $id): JsonResponse
    {
        $item = Market::query()->findOrFail($id);
        $item->delete();
        return response()->json();
    }
}

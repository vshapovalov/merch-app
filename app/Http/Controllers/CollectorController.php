<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductCollectedDataRequest;
use App\Http\Requests\CreateCollectedDataRequest;
use App\Models\CollectedData;
use Illuminate\Http\JsonResponse;

class CollectorController extends Controller
{
    function list(): JsonResponse
    {
        return response()->json(
            CollectedData::query()->with(['market'])->get()
        );
    }

    function get(string $id): JsonResponse
    {
        return response()->json(
            CollectedData::query()->with(['market', 'products'])->findOrFail($id)
        );
    }

    function getProducts(string $id): JsonResponse
    {
        return response()->json(
            CollectedData::query()->with(['products'])->findOrFail($id)->products
        );
    }

    function deleteProduct(string $id, string $productId): JsonResponse
    {
        /** @var CollectedData $item */
        $item = CollectedData::query()->findOrFail($id);
        $item->products()->detach([$productId]);
        return response()->json();
    }

    function addProduct(string $id, AddProductCollectedDataRequest $request): JsonResponse
    {
        /** @var CollectedData $item */
        $item = CollectedData::query()->findOrFail($id);
        $item->products()->attach($request->get('id'), [
            'price' => $request->get('price'),
            'qty' => $request->get('qty'),
        ]);

        return response()->json();
    }

    function create(CreateCollectedDataRequest $request): JsonResponse
    {
        $item = new CollectedData();
        $item->description = $request->get('description');
        $item->market_id = $request->get('market_id');
        $item->collected_at = $request->get('collected_at');
        $item->save();

        $item->products()->sync($this->mapRequestToProducts($request->get('products')), false);
        return response()->json(['id' => $item->id]);
    }

    private function mapRequestToProducts(array $productsRaw): array
    {
        $products = [];
        foreach ($productsRaw as $product) {
            $products[$product['id']] = [
                'price' => $product['price'],
                'qty' => $product['qty'],
            ];
        }
        return $products;
    }

    function update(string $id, CreateCollectedDataRequest $request): JsonResponse
    {
        /** @var CollectedData $item */
        $item = CollectedData::query()->findOrFail($id);
        $item->description = $request->get('description');
        $item->market_id = $request->get('market_id');
        $item->collected_at = $request->get('collected_at');
        $item->save();
        $item->products()->sync($this->mapRequestToProducts($request->get('products')));
        return response()->json(['id' => $item->id]);
    }

    function delete(string $id): JsonResponse
    {
        $item = CollectedData::query()->findOrFail($id);
        $item->delete();
        return response()->json();
    }
}

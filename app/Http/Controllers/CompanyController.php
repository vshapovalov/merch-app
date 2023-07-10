<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    function list(): JsonResponse
    {
        return response()->json(Company::query()->get());
    }

    function get(string $id): JsonResponse
    {
        return response()->json(Company::query()->findOrFail($id));
    }

    function create(CreateCompanyRequest $request): JsonResponse
    {
        $item = new Company();
        $item->name = $request->get('name');
        $item->report_tab_color = $request->get('report_tab_color');
        $item->save();
        return response()->json(['id' => $item->id]);
    }

    function update(string $id, CreateCompanyRequest $request): JsonResponse
    {
        $item = Company::query()->findOrFail($id);
        $item->name = $request->get('name');
        $item->report_tab_color = $request->get('report_tab_color');
        $item->save();
        return response()->json(['id' => $item->id]);
    }

    function delete(string $id): JsonResponse
    {
        $item = Company::query()->findOrFail($id);
        $item->delete();
        return response()->json();
    }
}

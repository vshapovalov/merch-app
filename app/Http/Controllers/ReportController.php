<?php

namespace App\Http\Controllers;

use App\Actions\GenerateMerchReport;
use App\Http\Requests\GenerateMerchReportRequest;

class ReportController extends Controller
{
    public function generateMerchReport(GenerateMerchReportRequest $request): mixed
    {
        $year = $request->get('year');
        $week = $request->get('week');
        $action = new GenerateMerchReport();
        $filename = $action->execute($year . str_pad($week, 2, "0", STR_PAD_LEFT));
        return response()->json(['filename' => $filename]);
    }
}

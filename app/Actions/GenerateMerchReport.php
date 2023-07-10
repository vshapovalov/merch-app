<?php

namespace App\Actions;

use App\Models\Category;
use App\Models\Company;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GenerateMerchReport
{
    const PAGE_START_PADDING_ROWS = 4;
    const PAGE_MARKETS_GAP_ROWS = 2;

    public function execute(string $yearWeek): string
    {
        $year = substr($yearWeek, 0, 4);
        $week = (int)substr($yearWeek, 4, 2);

        $weeks = range(1, $week);

        $companies = Company::query()->with(['markets'])->get();
        $categories = Category::query()->with(['children'])->get();

        $spreadsheet = new Spreadsheet();
        for ($i = 0; $i < count($spreadsheet->getAllSheets()); $i++) {
            $spreadsheet->removeSheetByIndex($i);
        }

        foreach ($companies as $company) {

            $worksheet = new Worksheet();
            $worksheet->setTitle($company->name);
            $worksheet->getTabColor()->setRGB($company->report_tab_color);
//            foreach ($company->markets as $market) {
//
//            }
//            $worksheet
            $spreadsheet->addSheet($worksheet);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        return "hello world.xlsx";
    }
}

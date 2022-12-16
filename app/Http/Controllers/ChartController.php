<?php

namespace App\Http\Controllers;

use App\Models\donate;
use App\Models\expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    //Chart Index Page
    public function indexIncomeChart()
    {
        //   InCome Chart
       $donate =donate::select(DB::raw("SUM(donation_amount) as amount"),DB::raw('MONTHNAME(updated_at) as month_name'))
                        ->whereYear('updated_at',date('Y'))
                        ->groupBy(DB::raw('monthname(updated_at)'))
                        ->orderBy(DB::raw('month(updated_at)'))
                        ->pluck('amount','month_name');

        $incomelabels = $donate->keys();
        $incomedata = $donate->values();


        return view('admin.chart.indexIncomeChart', compact('incomelabels', 'incomedata'));
    }


    //  CSV Total Income Download

    public function incomeCsvDownload(){
    $income=donate::select('donates.*','categories.category_name','users.name','donates.created_at','donates.updated_at')
                     ->join('categories','donates.category_id','=','categories.category_id')
                     ->join('users','donates.user_id','=','users.id')
                     ->get();

    $csvExporter= new \Laracsv\Export();

    $csvExporter->build($income,[
        'name'=> "Receiver Name",
        'donator_name'=>'Donator_name',
        'category_name'=>'Category',
        'donation_amount'=>'Donation_amount',
        'created_at'=>'Donated Date',
        'updated_at'=>'Updated Date'
    ]);

    $csvReader=$csvExporter->getReader();

    $csvReader->setOutputBOM(str:\League\Csv\Reader::BOM_UTF8);
    $filename='incomeList.csv';
    return response((string)$csvReader)->header(key:'Content-Type', values:'text/csv; charset=UTF-8')
                                       ->header(key:'Content-Disposition', values:'attachment; filename="'.$filename.'"');
    }

    public function indexExpenseChart(){

        //  Expense Chart
        $expense =expense::select(DB::raw("SUM(expense_amount) as amount"),DB::raw('MONTHNAME(updated_at) as month_name'))
                        ->whereYear('updated_at',date('Y'))
                        ->groupBy(DB::raw('monthname(updated_at)'))
                        ->orderBy(DB::raw('month(updated_at)'))
                        ->pluck('amount','month_name');

        $expenselabels = $expense->keys();
        $expensedata = $expense->values();

        return view('admin.chart.indexExpenseChart', compact('expenselabels','expensedata'));
    }

    //  CSV Total Expense Download

    public function expenseCsvDownload(){
        $expense=expense::select('expenses.*','categories.category_name','users.name')
                        ->join('categories','expenses.category_id','=','categories.category_id')
                        ->join('users','expenses.user_id','=','users.id')
                        ->get();

        $csvExporter= new \Laracsv\Export();

        $csvExporter->build($expense,[
            'name'=> "Expense User",
            'category_name'=>'Category',
            'expense_amount'=>'Expense_amount',
            'expense_description'=>'Description',
            'created_at'=>'Expense Date',
            'updated_at'=>'Updated Date'
        ]);

        $csvReader=$csvExporter->getReader();

        $csvReader->setOutputBOM(str:\League\Csv\Reader::BOM_UTF8);
        $filename='expenseList.csv';
        return response((string)$csvReader)->header(key:'Content-Type', values:'text/csv; charset=UTF-8')
                                           ->header(key:'Content-Disposition', values:'attachment; filename="'.$filename.'"');
        }
}

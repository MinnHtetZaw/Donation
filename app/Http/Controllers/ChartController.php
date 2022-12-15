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
}

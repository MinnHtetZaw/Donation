<?php

namespace App\Http\Controllers;

use App\Models\expense;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    // Show Expense Page
    public function indexExpense(){
        $category=category::get();
        return view('admin.expense.indexExpense',compact('category'));
    }

     // Expense Usage Page
    public function usageExpense(Request $request,$id){
        $validator = $this->validationExpenseCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data=$this->getExpenseData($request,$id);

        expense::create($data);

        return back()->with(['ExpenseSuccess'=>'Expense Succeed!']);

    }

    // Expense List Page

    public function listExpense(){
        $listData= expense::select('expenses.*','categories.category_name','users.name')
                            ->join('categories','expenses.category_id','=','categories.category_id')
                            ->join('users','expenses.user_id','=','users.id')
                            ->get();

        $totalamount=expense::select(DB::raw('SUM(expense_amount) as total'))
                            ->get();

        return view('admin.expense.listExpense',compact('listData','totalamount'));
    }

    // Search Expense Data

    public function searchExpense(Request $request){

        $searchData =expense::select('expenses.*','categories.category_name','users.name')
                            ->orWhere('category_name','LIKE','%'.$request->searchExpense.'%')
                            ->orWhere('name','LIKE','%'.$request->searchExpense.'%')
                            ->orWhere('expense_amount','LIKE','%'.$request->searchExpense.'%')
                            ->orWhere('expense_description','LIKE','%'.$request->searchExpense.'%')
                            ->orWhere('expenses.created_at','LIKE','%'.$request->searchExpense.'%')
                            ->orWhere('expenses.updated_at','LIKE','%'.$request->searchExpense.'%')
                            ->join('categories','expenses.category_id','=','categories.category_id')
                            ->join('users','expenses.user_id','=','users.id')
                            ->get();

        $totalamount=expense::select(DB::raw('SUM(expense_amount) as total'))
                            ->get();
        return view('admin.expense.listExpense')->with(['listData'=>$searchData,'totalamount'=>$totalamount]);
    }

    // Edit Expense Page
     public function editExpense($id){
        $listData= expense::select('expenses.*','categories.category_name','users.name')
                         ->where('expenses.expense_id',$id)
                         ->join('categories','expenses.category_id','=','categories.category_id')
                         ->join('users','expenses.user_id','=','users.id')
                         ->get();
        $category=category::get();
        return view('admin.expense.editExpense',compact('listData','category'));
    }

    // Update Expense Data

    public function updateExpense(Request $request,$id){

        $validator = $this->validationExpenseCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data=$this->getExpenseUpdateData($request);

        expense::where('expense_id',$id)->update($data);

        return back()->with(['expenseUpdateSuccess'=>'Expense Update Succeed!']);

    }

    // Delete Donation Data
    public function deleteExpense($id){
        expense::where('expense_id',$id)->delete();
        return back()->with(['expenseDelete'=>'ExpenseData is Deleted!!!']);
    }


     //  User Profile Validation Check
     private function validationExpenseCheck($request){
        return
            Validator::make($request->all(),
            [
                'expenseDescription' => 'required',
                'amount' => 'required',
                'category'=>'required',

            ]);
        }
        private function getExpenseData($request,$id){
            return [
                'expense_description'=>  $request->expenseDescription,
                'expense_amount'=> $request->amount,
                'category_id'=>$request->category,
                'user_id'=>$id,

            ];
        }

        private function getExpenseUpdateData($request){
            return [
                'expense_description'=>  $request->expenseDescription,
                'expense_amount'=> $request->amount,
                'category_id'=>$request->category,
                'user_id'=>Auth::user()->id,

            ];
        }
}

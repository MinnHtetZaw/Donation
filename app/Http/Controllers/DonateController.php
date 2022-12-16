<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\donate;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonateController extends Controller
{
    // Index Donation Page
    public function indexDonate(){
        $category=category::get();
        return view('admin.donate.indexDonation',compact('category'));
    }

    // Donate Income Page
    public function incomeDonate(Request $request,$id){
        $validator = $this->validationDonateCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data=$this->getDonationData($request,$id);

        donate::create($data);

        return back()->with(['donateSuccess'=>'Donation Succeed!']);

    }

    // Donation List page
    public function listDonate(){
        $listData= donate::select('donates.*','categories.category_name','users.name')
                            ->join('categories','donates.category_id','=','categories.category_id')
                            ->join('users','donates.user_id','=','users.id')
                            ->get();

        $totalamount=donate::select(DB::raw('SUM(donation_amount) as total'))
                             ->get();

        return view('admin.donate.listDonation',compact('listData','totalamount'));
    }

    // Search Donation Data
    public function searchDonate(Request $request){

        $searchData =donate::select('donates.*','categories.category_name','users.name')
                            ->orWhere('category_name','LIKE','%'.$request->searchDonate.'%')
                            ->orWhere('name','LIKE','%'.$request->searchDonate.'%')
                            ->orWhere('donation_amount','LIKE','%'.$request->searchDonate.'%')
                            ->orWhere('donator_name','LIKE','%'.$request->searchDonate.'%')
                            ->orWhere('donates.created_at','LIKE','%'.$request->searchDonate.'%')
                            ->orWhere('donates.updated_at','LIKE','%'.$request->searchDonate.'%')
                            ->join('categories','donates.category_id','=','categories.category_id')
                            ->join('users','donates.user_id','=','users.id')
                            ->get();

        $totalamount=donate::select(DB::raw('SUM(donation_amount) as total'))
                            ->get();
        return view('admin.donate.listDonation')->with(['listData'=>$searchData,'totalamount'=>$totalamount]);
    }

    // Edit Donation Page
    public function editDonation($id){
        $listData= donate::select('donates.*','categories.category_name','users.name')
                         ->where('donates.donate_id',$id)
                         ->join('categories','donates.category_id','=','categories.category_id')
                         ->join('users','donates.user_id','=','users.id')
                         ->get();
        $category=category::get();
        return view('admin.donate.editDonation',compact('listData','category'));
    }

    // Update Donation Page
    public function updateDonation(Request $request,$id){

        $validator = $this->validationDonateCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data=$this->getDonationData($request);

        donate::where('donate_id',$id)->update($data);

        return back()->with(['donateUpdateSuccess'=>'Donation Update Succeed!']);

    }

    // Delete Donation Data
    public function deleteDonation($id){
            donate::where('donate_id',$id)->delete();
            return back();
    }

    //  Private Function ONLY

    //  User Profile Validation Check
    private function validationDonateCheck($request){
        return
            Validator::make($request->all(),
            [
                'donatorName' => 'required',
                'amount' => 'required',
                'category'=>'required',

            ]);
        }
        private function getDonationData($request){
            return [
                'donator_name'=>  $request->donatorName,
                'donation_amount'=> $request->amount,
                'category_id'=>$request->category,
                'user_id'=>Auth::user()->id,

            ];
        }
}

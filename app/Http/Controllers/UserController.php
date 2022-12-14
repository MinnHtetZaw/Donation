<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // show index of Admin Dashboard
    public function index(){

        $id=Auth::user()->id;
        $userData=User::where('id',$id)->first();
        return view('admin.profile.index',compact('userData'));
    }

    // Edit / Update Profile detail

    public function updateProfile (Request $request,$id){
        $validator = $this->validationProfileCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $Data= $this->getUserData($request);


        User::where('id',$id)->update($Data);
        $userData=User::where('id',$id)->first();

        return back()->with(['userData'=>$userData]);
    }

    //  Edit Password Page
    public function editPassword(){
        return view('admin.profile.changePassword');
    }

    // Update Password Page
    public function changePassword(Request $request,$id){
        $validator = $this->validationPasswordCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $dbPassword=User::select('password')->where('id',$id)->first();

        $hashNewPassword=Hash::make($request->newPassword);
        $updatePassword=[
            'password'=>$hashNewPassword,
        ];

        if(Hash::check($request->oldPassword,$dbPassword->password))
        {
            User::where('id',$id)->update($updatePassword);
            return redirect()->route('admin#editPassword')->with(['updatePasswordSuccess'=>'Password Update Procces Succeed!!']);
        }else{
            return back()->with(['fails'=>'Old Password does not match!']);
        }



    }

    //  Private Function ONLY

    //  User Profile Validation Check
    private function validationProfileCheck($request){
        return
            Validator::make($request->all(),
            [
                'userName' => 'required',
                'userEmail' => 'required',
                'userPhone' => 'required',
                'userAddress'=>'required'
            ]);
        }

    private function getUserData($request){
        return [
            'name'=>  $request->userName,
            'email'=> $request->userEmail,
            'phone'=> $request->userPhone,
            'address'=> $request->userAddress,
        ];
    }

    // User Password Validation Check
    private function validationPasswordCheck($request){
        return
            Validator::make($request->all(),
            [
                'oldPassword' => 'required',
                'newPassword' => 'required',
                'confirmedPassword' => 'required|same:newPassword',
            ]);
        }
}


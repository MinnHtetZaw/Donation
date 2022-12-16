<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserListController extends Controller
{
    //  User List Show Page
    public function index(){
        $userData=User::get();
        return view('admin.userList.list',compact('userData'));
    }

    // User Detail Show Page
    public function editUser($id){
        $uData=User::where('id',$id)->first();
        return view('admin.userList.edit',compact('uData'));
    }

    // Update User Detail Page
    public function updateUser(Request $request,$id){
        $validator= $this->validationProfileCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $Data= $this->getUserData($request);



        User::where('id',$id)->update($Data);
        $userData=User::where('id',$id)->first();
        return back()->with(['UserUpdateSuccess'=>'Update User Scceed!','uData'=>$userData]);
    }

    // Delete User Page
    public function deleteUser($id){
        User::where('id',$id)->delete();
        return back();
    }
    // Search User List
    public function searchUser(Request $request){
        $searchUser=$request->searchUser;
        $userData=User::Where('name','LIKE','%'.$searchUser.'%')
                        ->orWhere('phone','LIKE','%'.$searchUser.'%')
                        ->orWhere('email','LIKE','%'.$searchUser.'%')
                        ->orWhere('address','LIKE','%'.$searchUser.'%')
                        ->orWhere('role','LIKE','%'.$searchUser.'%')
                        ->get();

        return view('admin.userList.list')->with(['userData'=>$userData]);
    }

    // Private Function ONLY!!!

    // validation UserData
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
                'role'=>$request->userRole,
            ];
        }


}

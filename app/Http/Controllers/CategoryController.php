<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Category Show Page
    public function indexCategory(){
        $categoryData=category::get();
        return view('admin.category.indexCategory',compact('categoryData'));
    }

    // Create Category
    public function createCategory(Request $request){
        $validator =$this->validationCategoryCheck($request);
        if($validator->fails()){
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = $this->getCategoryData($request);

        category::create($data);
        $categoryData=category::get();
        return view('admin.category.indexCategory',compact('categoryData'));
    }

    // Direct Edit Category Page
    public function editCategory($id){
        $categoryData=category::where('category_id',$id)->first();
        return view('admin.category.editCategory',compact('categoryData'));
    }

    // Update Category Data
    public function updateCategory(Request $request, $id){
        $validator=$this->validationCategoryUpdateCheck($request);
        if($validator->fails()){
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data=$this->getUpdateCategoryData($request);
        category::where('category_id',$id)->update($data);

        return back()->with(['updateSuccess'=>'Catagory is Updated']);
    }

    //Delete Category Data
    public function deleteCategory($id){
            category::where('category_id',$id)->delete();
            return back();
    }
    // Search Category Data
    public function searchCategory(Request $request){
        $searchData =category::where('category_name','LIKE','%'.$request->searchCategory.'%')->get();
        return view('admin.category.indexCategory')->with(['categoryData'=>$searchData]);
    }


    // Private Function ONLY!!!


    // Validation Check Function For Category
    private function validationCategoryCheck($request){
        return
             Validator::make($request->all(),[
                'categoryName'=>'required',
        ]);
    }

    // get Category Data
    private function getCategoryData($request){
        return [
            'category_name'=>$request->categoryName,
        ];
    }

    // Validation Update data check Category
    private function validationCategoryUpdateCheck($request){
        return
        Validator::make($request->all(),[
            'categoryName'=>'required',
    ]);
    }

    // get Update Catergory Data
    private function getUpdateCategoryData($request){
        return [
            'category_name'=>$request->categoryName,
        ];
    }
}

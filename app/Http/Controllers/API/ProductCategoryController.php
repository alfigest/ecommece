<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    //
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('id');
        $show_product = $request->input('show_product');


        if($id){
           $category = ProductCategory::with(['products'])->find($id);

           if($category){
               return ResponseFormatter::success(
                   $category,
                   'Data kategori sukses di ambil'
                   
               );
           }

           else{
            return ResponseFormatter::error(
                null,
                'Data kategori gagal di ambil',
                404
            );
           }

        }
       

           $category = ProductCategory::query();

           if($name){
               $category->where('name', 'like', '%' . $name . "%");
           }


          

           if($show_product){
               $category->with('products');
           }

           return ResponseFormatter::success(
            $category->paginate($limit),
            ' list kategory sukses di ambil'
        );

       }
    }


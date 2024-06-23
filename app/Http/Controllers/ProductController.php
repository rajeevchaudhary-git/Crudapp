<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10); // 10 items per page
        return view('Products.ProductView', ['products' => $products]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Products.AddProduct');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        $request->validate([
            'name'=>'required',
            'des'=>'required',
            'discount'=>'required',
            'single_image'=>'required|mimes:jpg,jpeg,png,gif|max:1000',
        ]);
        // model class objcet 
        $file = $request->file('single_image');
        $imageName = " ";
        $filePath = 'upload/';
        $imagePaths = []; 
        $name = $request->name;
        $old_price = $request->old_price;
        $selling_price = $request->selling_price;
        $discount = $request->discount;
        $old_price = $request->old_price;
        $description = $request->des;


        if($file){
        // file upload on server 
        $imageName .= time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('upload'), $imageName);
        $filePath.=$imageName;
        }
        else{
            $filePath="No image is provided";
        }



    


        // multiple file upload
        
        $multiFile  = $request->file('multiple_image');
        if($multiFile){
            foreach($multiFile as $file){
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload'), $imageName);
                $imagePaths[] = 'upload/' . $imageName;
            }
           
           
        }
        if(!$multiFile){
            $imagePaths = "No file Is provided ";
        }

        $products = new Product;
        $products->name=$name;
        $products->description=$name;
        $products->price=$selling_price;
        $products->image=$filePath;
        $products->mutipleimage=json_encode($imagePaths);
        $products->discount=$discount;
        $products->old_price=$old_price;
      
        $products->save();
        return redirect()->route('products.index')->withSucess('product Created');
    

       
        // dd($request->all());

        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('id',$id)->first();

        return view('products.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $products =  Product::where('id',$id)->first();
        $request->validate([
            'name'=>'required',
            'des'=>'required',
            'single_image'=>'nullable|mimes:jpg,jpeg,png,gif|max:1000',
        ]);
        // model class objcet 
        $file = $request->file('single_image');
        $imageName = " ";
        $filePath = 'upload/';
        $imagePaths = []; 
        $name = $request->name;
        $old_price = $request->old_price;
        $des = $request->des;
        $selling_price = $request->selling_price;
        $discount = $request->discount;
        $old_price = $request->old_price;
        $description = $request->des;


        if($file){
        // file upload on server 
        $imageName .= time() . '.' . $file->getClientOriginalExtension();
        $filePath.=$imageName;
        $file->move(public_path('upload'), $imageName);
        $products->image=$filePath;
        $products->save();


        }
      
        // multiple file upload
        
        $multiFile  = $request->file('multiple_image');
        if($multiFile){
            foreach($multiFile as $file){
                $imageName2 = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload'), $imageName2);
                $imagePaths[] = 'upload/' . $imageName2;
            }
            $products->mutipleimage=json_encode($imagePaths);
            $products->save();
        }
        
        $products->name=$name;
        $products->description=$des;
        $products->price=$selling_price;
        $products->discount=$discount;
        $products->old_price=$old_price;
      
        $products->save();
        return redirect()->route('products.index')->withSucess('product Updated');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id',$id)->first();
        $product->delete();
         return redirect()->route('products.index')->withSucess('product deleted');
    }
}
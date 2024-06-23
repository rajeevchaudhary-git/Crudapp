<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/demo', function () {
    echo "hello";
});

Route::post('/test',function(){
    echo "post Routing";
});
Route::any('/test/any',function(){
    echo "post Routing";
});
Route::get('/test/demo/{name}/{id?}',function($name,$id=null){
    $data = compact('name','id');
   return view('Demo')->with($data);
});

Route::get('/home/{name?}',function($name=null){
    $demo = '<h2>welcome guys hello</h2>';
    $data = compact('name','demo');
    return view('home')->with($data);

});

Route::get('/product-view',function(){
    return view('ProductView');
});

Route::get('/add-product',function(){
    return view('AddProduct');
});

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
Route::get('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
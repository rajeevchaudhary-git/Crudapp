@extends('layout.main')

@section('main-section')
@push('title')
<title>Add New Product</title>
@endpush
@if($message=Session::get('success'))
<div class="alert alert-success alert-block">
    
    <strong>{{$message}}</strong>
</div>
@endif

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <form class="w-50" action="/products/store" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label for="exampleInputEmail1" class="form-label">Product name</label>
            <input value='{{old("name")}}' name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            @if($errors->has('name'))
            <span class="text-danger">{{$errors->first('name')}}</span>
            @endif
        </div>

        <div class="mb-6">
            <label for="exampleInputEmail1" class="form-label">Descriptions</label>
            <input value='{{old("des")}}' name="des" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            @if($errors->has('des'))
            <span class="text-danger">{{$errors->first('des')}}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Old Price</label>
            <input value='{{old("old_price")}}'  name="old_price" type="text" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">selling Price</label>
            <input value='{{old("selling_price")}}' name="selling_price" type="text" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
        <label for="formFile" class="form-label">Single-image</label>
        <input  name="single_image" class="form-control" type="file" id="formFile">
        @if($errors->has('single_image'))
            <span class="text-danger">{{$errors->first('single_image')}}</span>
            @endif
       </div>
        <div class="mb-3">
        <label for="formFile" class="form-label">multiple-image</label>
        <input name="multiple_image[]" class="form-control" type="file" id="formFile"  multiple >
       </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Discount</label>
            <input  name="discount" type="text" class="form-control" id="exampleInputPassword1">
            @if($errors->has('discount'))
            <span class="text-danger">{{$errors->first('discount')}}</span>
            @endif
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

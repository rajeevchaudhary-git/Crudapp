@extends('layout.main')

@section('main-section')
@push('title')
<title>View All Product </title>
@endpush
@if($message=Session::get('success'))
<div class="alert alert-success alert-block">
    
    <strong>{{$message}}</strong>
</div>
@endif


<div class="container">
<div class="table-responsive mt-3">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Product-Id</th>
      <th scope="col">Name</th>
      <th scope="col">cancelled-price</th>
      <th scope="col">Selling-Price</th>
      <th scope="col">Images</th>
      <th scope="col">multipleImages</th>
      <th scope="col">discount</th>
   
      <th scope="col">edit</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $product)
    <tr>
    @if($product=="")
<div>NO data available</div>
@endif
      <th scope="row">{{$loop->index}}</th>
      <td>{{$product->name}}</td>
      <td> ₹ {{$product->old_price}}</td>
      <td> ₹ {{$product->price}}</td>
      <td><img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50"></td>
            <td>
                @if(is_array(json_decode($product->mutipleimage)))
                    @foreach(json_decode($product->mutipleimage) as $image)
                        <img src="{{ asset($image) }}" alt="{{ $product->name }}" width="50">
                    @endforeach
                @else
                    <img src="{{ asset($product->mutipleimage) }}" alt="{{ $product->name }}" width="50">
                @endif
            </td>
      <td>{{$product->discount}} %</td>
      
      <td><a href="/products/{{$product->id}}/edit" ><button type="submit" class="btn btn-primary">edit</button></a>
      </td>
      <td><a href="/products/{{$product->id}}/delete"><button type="button" class="btn btn-danger">delete</button></a>
      </td>
    
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
{{$products->links()}}

@endsection

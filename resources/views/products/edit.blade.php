@extends('layouts.app')

@section('title')

    Product Edit

@endsection

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <form action="{{route('product.update',$product)}}" method="POST" enctype="multipart/form-data">

                    {{csrf_field()}}

                    <div class="form-group">

                        <label for="supplier">Supplier</label>

                        <select name="supplier_id" id="supplier" class="form-control">

                            <option selected disabled>Select Supplier</option>

                            @foreach($suppliers as $id => $name)

                                <option value="{{$id}}" {{$product->supplier_id == $id ? "selected" : ""}}>{{$name}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="description">Description</label>

                        <input name="description" type="text" class="form-control" id="description"
                               placeholder="product description" value="{{old('description') ? old('description') : $product->description}}" required>

                    </div>

                    <div class="form-group">

                        <label for="price">Price</label>

                        <input name="price" type="number" class="form-control" id="price"
                               placeholder="product price" value="{{old('price') ? old('price') : $product->price}}" required>

                    </div>

                    <div class="form-group">

                        <label for="quantity">Quantity</label>

                        <input name="quantity" type="number" class="form-control" id="quantity"
                               placeholder="product quantity" value="{{old('quantity') ? old('quantity') : $product->quantity}}" required>

                    </div>

                    <div class="form-group">

                        <label for="image">Image</label>

                        <input name="image_path" type="file" class="form-control" id="image"
                               placeholder="product image" value="{{old('image')}}">

                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>

                    <button class="btn btn-default" onclick="cancel()">cancel</button>

                </form>

            </div>

            <div class="col-md-4">

                <div class="panel panel-default">

                    <div class="panel panel-heading">

                        <strong>Date & Time</strong>

                    </div>

                    <div class="panel-body">

                        <span id='ct'></span>

                    </div>

                </div>

            </div>

        </div>

    </div>

@section('js')

    <script src="{{url('js/DateTime.js')}}"></script>

    <script src="{{url('js/ImageReader.js')}}"></script>

    <script src="{{url('js/CancelButton.js')}}"></script>

@endsection

@endsection
@extends('layouts.app')

@section('title')

    Products

@endsection

@section('content')

    <div class="container">

        <div class="table-responsive">

            <table class="table table-hover table-condensed">

                <tr>

                    <th>#</th>

                    <th>Supplier Name</th>

                    <th>Barcode</th>

                    <th>Description</th>

                    <th>Price</th>

                    <th>Quantity</th>

                    <th>Actions</th>

                </tr>

                @foreach($products as $product)

                    <tr>

                        <td>{{$product->id}}</td>

                        <td>{{$product->supplier->name}}</td>

                        <td>{{$product->barcode}}</td>

                        <td>{{$product->description}}</td>

                        <td>{{$product->price}}</td>

                        <td>{{$product->quantity}}</td>

                        <td>

                            <a href="{{route('product.edit',$product)}}" class="btn btn-primary btn-xs">Edit</a>

                            <form action="{{route('product.destroy',$product)}}" method="post" style="display: inline;">

                                {{csrf_field()}}

                                {{method_field('DELETE')}}

                                <button class="btn btn-danger btn-xs">Delete</button>

                            </form>

                        </td>

                    </tr>

                @endforeach

            </table>

        </div>

    </div>

@endsection
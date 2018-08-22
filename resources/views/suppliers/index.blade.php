@extends('layouts.app')

@section('title')

    Suppliers

@endsection

@section('content')

    <div class="container">

        <div class="table-responsive">

            <table class="table table-hover table-condensed">

                <tr>

                    <th>#</th>

                    <th>Name</th>

                    <th>Code</th>

                    <th>Address</th>

                    <th>Contact Person</th>

                    <th>Contact Information</th>

                    <th>Actions</th>

                </tr>

                @foreach($suppliers as $supplier)

                    <tr>

                        <td>{{$supplier->id}}</td>

                        <td>{{$supplier->name}}</td>

                        <td>{{$supplier->code}}</td>

                        <td>{{$supplier->address}}</td>

                        <td>{{$supplier->contact_person}}</td>

                        <td>{{$supplier->contact_information}}</td>

                        <td>

                            <a href="{{route('supplier.edit',$supplier)}}" class="btn btn-primary btn-xs">Edit</a>

                            <form action="{{route('supplier.destroy',$supplier)}}" method="post" style="display: inline;">

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
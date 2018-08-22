@extends('layouts.app')

@section('title')

    {{$supplier->name}} Supplier Edit

@endsection

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <form action="{{route('supplier.update',$supplier)}}" method="POST">

                    {{csrf_field()}}

                    <div class="form-group">

                        <label for="name">Name</label>

                        <input name="name" type="text" class="form-control" id="name"
                               placeholder="supplier name" value="{{old('name') ? old('name') : $supplier->name}}" required>

                    </div>

                    <div class="form-group">

                        <label for="code">Code</label>

                        <input name="code" type="text" class="form-control" id="code"
                               placeholder="supplier code" value="{{old('code') ? old('code') : $supplier->code}}" required>

                    </div>

                    <div class="form-group">

                        <label for="address">Address</label>

                        <input name="address" type="text" class="form-control" id="address"
                               placeholder="supplier address" value="{{old('address') ? old('address') : $supplier->address}}" required>

                    </div>

                    <div class="form-group">

                        <label for="contact_person">Contact Person</label>

                        <input name="contact_person" type="text" class="form-control" id="contact_person"
                               placeholder="supplier contact person" value="{{old('contact_person') ? old('contact_person') : $supplier->contact_person}}" required>

                    </div>

                    <div class="form-group">

                        <label for="contact_information">Contact Information</label>

                        <input name="contact_information" type="text" class="form-control" id="contact_information"
                               placeholder="supplier contact information" value="{{old('contact_information') ? old('contact_information') : $supplier->contact_information}}" required>

                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                    <button class="btn btn-default" onclick="cancel()">cancel</button>

                </form>

                @include('layouts.errors')

            </div>

        </div>

    </div>

@section('js')

    <script src="{{url('js/CancelButton.js')}}"></script>

@endsection

@endsection
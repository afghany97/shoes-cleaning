@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <form action="/orders" method="POST" enctype="multipart/form-data">

                    {{csrf_field()}}

                    <div class="form-group">

                        <label for="mobile">mobile</label>

                        <input name="mobile" type="number" class="form-control" id="mobile"
                               placeholder="your mobile number" value="{{old('mobile')}}" required>

                        <button onclick="search()" type="button" class="btn btn-default btn-xs">search</button>


                    </div>

                    <div class="form-group">

                        <label for="name">name</label>

                        <input name="name" type="text" class="form-control" id="name" placeholder="your name"
                               value="{{old('name')}}" required>

                    </div>

                    <div class="form-group">

                        <label for="address">address</label>

                        <input name="address" type="text" class="form-control" id="address" placeholder="your address"
                               value="{{old('address')}}" required>

                    </div>

                    <div class="form-group">

                        <label for="price">price</label>

                        <input name="price" type="number" class="form-control" id="price" placeholder="price"
                               value="{{old('price')}}" required>

                    </div>

                    <div class="form-group">

                        <label for="image">Image</label>

                        <input name="image" type="file" class="form-control" id="image" value="{{old('image')}}"
                               accept="image/*" required>

                    </div>

                    <div class="form-group">

                        <select name="shoes_id" class="form-control" required>

                            <option value="">Select shoes type</option>

                            @foreach($shoess as $shoes)

                                <option value="{{$shoes->id}}" {{$shoes->id == old('shoes_id') ? 'selected' : ""}}>{{$shoes->type}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="delivery_date">delivery date</label>

                        <input name="delivery_date" type="date" class="form-control" id="delivery_date" placeholder="delivery date" value="{{old('delivery_date') ? old('delivery_date') : \Carbon\Carbon::now()->addDay(2)->toDateString()}}" required>

                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>

                    <button class="btn btn-default" onclick="cancel()">cancel</button>

                </form>

                @include('layouts.errors')

            </div>

            <div class="col-md-4">

                <span id='ct' ></span>

                <hr>

                <div class="form-group">

                    <img class="small-image" id="blah" src="#" alt="your image"/>

                </div>

            </div>

        </div>

    </div>


@endsection
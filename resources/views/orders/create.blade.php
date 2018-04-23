@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <form action="/orders" method="POST" enctype="multipart/form-data">

                    {{csrf_field()}}

                    <div class="form-group">

                        <label for="name">name</label>

                        <input name="name" type="text" class="form-control" id="name" placeholder="your name"
                               value="{{old('name')}}" required>

                    </div>

                    <div class="form-group">

                        <label for="mobile">mobile</label>

                        <input name="mobile" type="number" class="form-control" id="mobile"
                               placeholder="your mobile number" value="{{old('mobile')}}" required>

                    </div>

                    <div class="form-group">

                        <label for="image">Image</label>

                        <input name="image" type="file" class="form-control" id="image" value="{{old('image')}}"
                               accept="image/*" required>

                    </div>

                    <div class="form-group">

                        <img class="small-image" id="blah" src="#" alt="your image"/>

                    </div>


                    <div class="form-group">

                        <select name="shoes_id" class="form-control" required>

                            <option value="">Select shoes type</option>

                            @foreach($shoess as $shoes)

                                <option value="{{$shoes->id}}" {{$shoes->id == old('shoes_id') ? 'selected' : ""}}>{{$shoes->type}}</option>

                            @endforeach

                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>

                    <button class="btn btn-default">cancel</button>

                </form>

                @include('layouts.errors')

            </div>

            <div class="col-md-4">

                <span id='ct' ></span>

            </div>

        </div>

    </div>


@endsection
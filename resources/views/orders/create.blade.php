@extends('layouts.app')

@section('content')

    <div class="container">

        <form action="" method="POST" enctype="multipart/form-data">

            {{csrf_field()}}

            <div class="form-group">

                <label for="customer_name">Customer name</label>

                <input name = "customer_name" type="text" class="form-control" id="customer_name" placeholder="your name" value="{{old('customer_name')}}" required>

            </div>

            <div class="form-group">

                <label for="customer_mobile">Customer name</label>

                <input name = "customer_mobile" type="number" class="form-control" id="customer_mobile" placeholder="your mobile number" value="{{old('customer_mobile')}}" required>

            </div>

            <div class="form-group">

                <label for="image">Image</label>

                <input name ="image" type="file" class="form-control" id="image" value="{{old('image')}}" required>

            </div>


            <div class="form-group">

                <select name="shoes" class="form-control" required>

                    <option value="">Select shoes type</option>

                    {{--@foreach($channels as $channel)--}}

                        {{--<option value="{{$channel->id}}" {{$channel->id == old('channel_id') ? 'selected' : ""}}>{{$channel->name}}</option>--}}

                    {{--@endforeach--}}

                </select>

            </div>

            <button type="submit" class="btn btn-primary">Save</button>

            <button class="btn btn-default">cancel</button>

        </form>

    </div>

@endsection
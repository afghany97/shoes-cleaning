@extends('layouts.app')

@section('title')

    Create Order

@endsection

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <form action="{{route('order.store')}}" method="POST" enctype="multipart/form-data">

                    {{csrf_field()}}

                    <div class="form-group">

                        <label for="mobile">mobile</label>

                        <input name="mobile" type="number" class="form-control" id="mobile"
                               placeholder="your mobile number" value="{{old('mobile')}}" required>

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

                    <div class="checkbox">

                        <label>

                            <input type="checkbox" name="sensitive" value="1"> Is sensitive

                        </label>

                    </div>

                    <div class="form-group">

                        <label for="priority">Priority</label>

                        <select name="priority" id="priority" class="form-control">

                            @foreach(config('order.priority') as $key => $value)

                                <option value="{{$value}}" {{$key == "default" ?? "selected"}}>{{$key}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="image">Image</label>

                        <input name="images[]" type="file" class="form-control" id="image" value="{{old('image')}}" multiple
                               accept="image/*">

                    </div>

                    <div class="form-group">

                        <label for="shoes">Shoes Type</label>

                        <select name="shoes_id" id="shoes" class="form-control" required>

                            <option selected disabled>Select shoes type</option>

                            @foreach($shoes as $shoe)

                                <option value="{{$shoe->id}}" {{$shoe->id == old('shoes_id') ? 'selected' : ""}}>{{$shoe->type}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="delivery_date">delivery date</label>

                        <input name="delivery_date" type="text" class="form-control" id="delivery_date"
                               placeholder="pick delivery date by default after 2 days"
                               onfocus="(this.type = 'date')">

                    </div>

                    <div class="form-group">

                        <label for="note">Note</label>

                        <textarea name="note" type="text" class="form-control" id="note" placeholder="note...">{{old('note') ? old('note') : ""}}</textarea>

                    </div>

                    <button type="submit" class="btn btn-primary" onclick="{{$isThereFreeLocker ? "" : " return confirm('there is no free lockers , are you want to complete the operation?')"}}">Save</button>

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

                <hr>

                <div class="panel panel-default">

                    <div class="panel panel-heading">

                        <strong>Selected Image</strong>

                    </div>

                    <div class="panel-body">

                        <img class="small-image" id="blah" src="#" alt="your image" style="display: none"/>

                    </div>

                </div>

            </div>

        </div>

    </div>

@section('js')

    <script src="{{url('js/CustomerFinder.js')}}"></script>

    <script src="{{url('js/DateTime.js')}}"></script>

    <script src="{{url('js/ImageReader.js')}}"></script>

    <script src="{{url('js/CancelButton.js')}}"></script>

@endsection

@endsection
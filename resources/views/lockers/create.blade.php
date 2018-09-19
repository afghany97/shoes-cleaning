@extends('layouts.app')

@section('title')

    Create Lockers

@endsection

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <form action="{{route('locker.store')}}" method="POST">

                    {{csrf_field()}}

                    <div class="form-group">

                        <label for="start">Start</label>

                        <input name="start" type="number" class="form-control" id="start"
                               placeholder="please enter start range..." value="{{old('start')}}" required>

                    </div>

                    <div class="form-group">

                        <label for="end">End</label>

                        <input name="end" type="number" class="form-control" id="end"
                               placeholder="please enter end range..." value="{{old('end')}}" required>

                    </div>

                    <div class="form-group">

                        <label for="type">Type</label>

                        <select name="type" id="type" class="form-control">

                            <option selected disabled>Choose locker type</option>

                            @foreach(config('locker.type') as $type)

                                <option value="{{$type}}">{{$type}}</option>

                            @endforeach

                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>

                    <button class="btn btn-default" onclick="cancel()">cancel</button>

                </form>

            </div>

        </div>

    </div>

@section('js')

    <script src="{{url('js/CancelButton.js')}}"></script>

@endsection

@endsection
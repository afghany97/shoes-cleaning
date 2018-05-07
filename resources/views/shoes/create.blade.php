@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <form action="/shoes" method="POST">

                    {{csrf_field()}}

                    <div class="form-group">

                        <label for="shoes_type">Shoes type</label>

                        <input name="shoes_type" type="text" class="form-control" id="shoes_type"
                               placeholder="shoes type..."
                               value="{{old('shoes_type')}}" required>

                    </div>

                    <button type="submit" class="btn btn-primary">save</button>

                </form>

    @include('layouts.errors')

@endsection
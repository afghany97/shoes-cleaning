@extends('layouts.app')

@section('title')

    Create Shoes

@endsection

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <form action="{{route('shoes.store')}}" method="POST">

                    {{csrf_field()}}

                    <div class="form-group">

                        <label for="shoes_type">نوع الحذاء</label>

                        <input name="shoes_type" type="text" class="form-control" id="shoes_type"
                               placeholder="نوع الحذاء"
                               value="{{old('shoes_type')}}" required>

                    </div>

                    <button type="submit" class="btn btn-primary">حفظ</button>

                </form>

    @include('layouts.errors')

@endsection
@extends('layouts.app')

@section('title')

    Create Expense

@endsection

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <form action="{{route('expenses.store')}}" method="POST">

                    {{csrf_field()}}

                    <div class="form-group">

                        <label for="quantity">المصروفات</label>

                        <input name="quantity" type="number" class="form-control" id="quantity"
                               placeholder="المصروفات"
                               value="{{old('quantity')}}" required>

                    </div>

                    <div class="form-group">

                        <label for="description">السبب</label>

                        <input name="description" type="text" class="form-control" id="description"
                               placeholder="السبب"
                               value="{{old('description')}}" required>

                    </div>

                    <button type="submit" class="btn btn-primary">حفظ</button>

                </form>

    @include('layouts.errors')

@endsection
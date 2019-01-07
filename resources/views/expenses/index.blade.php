@extends('layouts.app'  )

@section('title')

    Expenses

@endsection

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                @forelse($expenses as $expens)

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            {{$expens->quantity}}

                        </div>

                        <div class="panel-body">

                            {{$expens->description}}

                        </div>

                    </div>

                @empty

                    <div class="text-center">

                        <h1>There is no expense</h1>

                    </div>

                @endforelse

                <div class="text-center">

                    {{$expenses->links()}}

                </div>

            </div>

        </div>

    </div>

@endsection

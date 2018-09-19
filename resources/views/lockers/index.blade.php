@extends('layouts.app')

@section('title')

    Lockers

@endsection

@section('content')

    <div class="container">

        <div class="table-responsive">

            <table class="table table-hover table-condensed">

                <tr>

                    <th>#</th>

                    <th>No.</th>

                    <th>Status</th>

                    <th>Type</th>

                    <th>Actions</th>

                </tr>

                @foreach($lockers as $locker)

                    <tr>

                        <td>{{$locker->id}}</td>

                        <td>{{$locker->number}}</td>

                        <td>{{$locker->status}}</td>

                        <td>{{$locker->type}}</td>

                        <td>

                            <form action="{{route('locker.destroy',$locker)}}" method="post">

                                {{csrf_field()}}

                                {{method_field('delete')}}

                                <button class="btn btn-danger btn-xs">Delete</button>

                            </form>

                        </td>

                    </tr>


                @endforeach

            </table>

        </div>

    </div>

@endsection
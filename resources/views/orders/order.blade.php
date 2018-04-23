@extends('layouts.app') @section('content')

    <div class="container">

        <table>

            <tr>

                <th>Customer name</th>

                <th>Customer mobile</th>

                <th>shoes type</th>

                <th>image</th>

            </tr>

            <tr>

                <td>{{$order->customer->name}}</td>

                <td>{{$order->customer->mobile}}</td>

                <td>null</td>

                <td><img src="/storage/{{$order->image_path}}" alt="image" class="small-image"></td>

            </tr>

        </table>

    </div>

@endsection
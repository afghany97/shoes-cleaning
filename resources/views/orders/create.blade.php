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

                        <label for="mobile">رقم الموبيل</label>

                        <input name="mobile" type="number" class="form-control" id="mobile"
                               placeholder="رقم موبيل العميل" value="{{old('mobile')}}" required>

                    </div>

                    <div class="form-group">

                        <label for="name">اسم العميل</label>

                        <input name="name" type="text" class="form-control" id="name" placeholder="اسم العميل"
                               value="{{old('name')}}" required>

                    </div>

                    <div class="form-group">

                        <label for="address">عنوان العميل</label>

                        <input name="address" type="text" class="form-control" id="address" placeholder="عنوان العميل"
                               value="{{old('address')}}" required>

                    </div>

                    <div class="form-group">

                        <label for="price">السعر</label>

                        <input name="price" type="number" class="form-control" id="price" placeholder="السعر"
                               value="{{old('price')}}" required>

                    </div>

                    <div class="checkbox hidden">

                        <label>

                            <input type="checkbox" name="sensitive" value="1"> Is sensitive

                        </label>

                    </div>

                    <div class="form-group hidden">

                        <label for="priority">Priority</label>

                        <select name="priority" id="priority" class="form-control ">

                            @foreach(config('order.priority') as $key => $value)

                                <option value="{{$value}}" {{$key == "default" ?? "selected"}}>{{$key}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="image">الصور</label>

                        <input name="images[]" type="file" class="form-control" id="image" accept="image/*" multiple>

                    </div>

                    <div class="form-group hidden">

                        <label for="video">Video</label>

                        <input name="videos[]" type="file" class="form-control" id="video" accept="video/*" multiple>

                    </div>


                    <div class="form-group">

                        <label for="shoes">نوع الحذاء</label>

                        <select name="shoes_id" id="shoes" class="form-control" required>

                            <option selected disabled>اختار نوع الحذاء</option>

                            @foreach($shoes as $shoe)

                                <option value="{{$shoe->id}}" {{$shoe->id == old('shoes_id') ? 'selected' : ""}}>{{$shoe->type}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="delivery_date">تريخ التسليم</label>

                        <input name="delivery_date" type="text" class="form-control" id="delivery_date"
                               placeholder="pick delivery date by default after 2 days"
                               onfocus="(this.type = 'date')">

                    </div>

                    <div class="form-group">

                        <label for="note">ملاحظات</label>

                        <textarea name="note" type="text" class="form-control" id="note" placeholder="ملاحظات">{{old('note') ? old('note') : ""}}</textarea>

                    </div>

                    <button type="submit" class="btn btn-primary" onclick="{{$isThereFreeLocker ? "" : " return confirm('there is no free lockers , are you want to complete the operation?')"}}">حفظ</button>

                    <button class="btn btn-default" onclick="cancel()">الغاء</button>

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
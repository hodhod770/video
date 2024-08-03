@extends('layouts.Out')
@section('con')
<div class="section" dir="rtl">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <center>
                    <img style="width: 300px; height: 300px;" src="{{asset('auth.jpg')}}" alt="">
                    <h4>ادخل بريدك الالكتروني</h4>
                    {{-- <p>تم ارسال الرمز الى {{session()->get('UAuth_not_auth')->email}}</p> --}}
                    {{-- {{$code}} --}}
                    <form action="{{route('sendemailforgetpassword')}}" method="post">
                        @csrf
                        <input required style="width: 400px" type="email" class="form-control" name="email" id="">
                       
                    <button type="submit" class="btn btn-primary m-2">ارسال رمز التحقق</button>
                    <br>
                    {{-- <a wire:click='Resend' style="cursor: pointer" class="text-primary">اعادة الارسال</a> --}}
                    </form>
                </center>
            </div>
        </div>
    </div>
</div>

@endsection
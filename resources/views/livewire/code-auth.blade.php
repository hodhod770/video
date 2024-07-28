<div>
    <div class="section" dir="rtl">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <center>
                        <img style="width: 300px; height: 300px;" src="{{asset('auth.jpg')}}" alt="">
                        <h4>ادخل رمز التحقق</h4>
                        <p>تم ارسال الرمز الى {{session()->get('UAuth_not_auth')->email}}</p>
                        {{-- {{$code}} --}}
                        <form wire:submit='CheckAuth' method="post">
                            <input wire:model='newcode' style="width: 400px" type="text" class="form-control" name="" id="">
                            @if ($err)
                                <span class="text-danger">{{$err}}</span>
                            @endif
                        <button type="submit" class="btn btn-primary m-2">تحقق</button>
                        <br>
                        <a wire:click='Resend' style="cursor: pointer" class="text-primary">اعادة الارسال</a>
                        </form>
                    </center>
                    
                </div>
            </div>
        </div>
    </div>
</div>

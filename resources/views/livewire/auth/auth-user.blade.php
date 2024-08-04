<div>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            /* Importing fonts from Google */
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

            /* Reseting */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
            }

            body {
                background: #ecf0f3;
            }

            .wrapper {
                max-width: 350px;
                min-height: 500px;
                margin: 80px auto;
                padding: 40px 30px 30px 30px;
                background-color: #ecf0f3;
                border-radius: 15px;
                box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
            }

            .logo {
                width: 80px;
                margin: auto;
            }

            .logo img {
                width: 100%;
                height: 80px;
                object-fit: cover;
                border-radius: 50%;
                box-shadow: 0px 0px 3px #5f5f5f,
                    0px 0px 0px 5px #ecf0f3,
                    8px 8px 15px #a7aaa7,
                    -8px -8px 15px #fff;
            }

            .wrapper .name {
                font-weight: 600;
                font-size: 1.4rem;
                letter-spacing: 1.3px;
                padding-left: 10px;
                color: #555;
            }

            .wrapper .form-field input {
                width: 100%;
                display: block;
                border: none;
                outline: none;
                background: none;
                font-size: 1.2rem;
                color: #666;
                padding: 10px 15px 10px 10px;
                /* border: 1px solid red; */
            }

            .wrapper .form-field {
                padding-left: 10px;
                margin-bottom: 20px;
                border-radius: 20px;
                box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
            }

            .wrapper .form-field .fas {
                color: #555;
            }

            .wrapper .btn {
                box-shadow: none;
                width: 100%;
                height: 40px;
                background-color: #03A9F4;
                color: #fff;
                border-radius: 25px;
                box-shadow: 3px 3px 3px #b1b1b1,
                    -3px -3px 3px #fff;
                letter-spacing: 1.3px;
            }

            .wrapper .btn:hover {
                background-color: #039BE5;
            }

            .wrapper a {
                text-decoration: none;
                font-size: 0.8rem;
                color: #03A9F4;
            }

            .wrapper a:hover {
                color: #039BE5;
            }

            @media(max-width: 380px) {
                .wrapper {
                    margin: 30px 20px;
                    padding: 40px 15px 15px 15px;
                }
            }
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    </head>

    <body>
        <div class="wrapper">
            <div class="logo">
                <img src="logo2.png" alt="">
            </div>
            <div class="text-center mt-4 name">
                منصة الهدهد ترحب بكم
            </div>
            @if ($Login)
                <form action="{{ route('userlogin') }}" method="POST" dir="rtl" class="p-3 mt-3">
                    @csrf
                    <div class="form-field d-flex align-items-center">
                        <span class="far fa-user"></span>
                        <input type="text" name="email" id="userName" placeholder="البريد الالكتروني">
                    </div>
                    <div class="form-field d-flex align-items-center">
                        <span class="fas fa-key"></span>
                        <input type="password" name="password" id="pwd" placeholder="كلمة السر">
                    </div>
                    <button class="btn mt-3">تسجيل الدخول</button>
                </form>
                <div dir="rtl" class="text-center fs-6">
                    <a class="m-1" href="{{ route('PasswordForget') }}">هل نسيت كلمة السر?</a> او <div wire:click='Loginstute'
                        class="m-1"  style="color: #039BE5; cursor: pointer;">انشاء حساب جديد</div>
                </div>
            @else
                <form action="{{ route('CreateU') }}" method="POST" dir="rtl" class="p-3 mt-3">
                    @csrf
                    <div class="form-field d-flex align-items-center">
                        <span class="far fa-user"></span>
                        <input required type="text" name="name" id="userName" placeholder="اسمك الرباعي">
                    </div>
                    <div class="form-field d-flex align-items-center">
                        <span class="far fa-user"></span>
                        <input required type="email" name="email" id="userName" placeholder="البريد الالكتروني">
                    </div>
                    <div class="form-field d-flex align-items-center">
                        <span class="fas fa-key"></span>
                        <input required type="password" name="password" id="pwd" placeholder="كلمة السر">
                    </div>
                    <button class="btn mt-3">تسجيل الدخول</button>
                </form>

                <div dir="rtl" class="text-center fs-6">
                    {{-- <a wire:click='Loginstute' style="color: #039BE5; cursor: pointer;">أملك حساب بالفعل</a> --}}
                    <div class="m-1" wire:click='Loginstute'
                        style="color: #039BE5; cursor: pointer;">أملك حساب بالفعل</div>
                </div>
            @endif
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>

    </html>
</div>

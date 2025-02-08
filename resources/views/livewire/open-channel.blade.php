<div>
    @php
        Carbon\Carbon::setLocale('ar');
    @endphp
    @section('newstyle')
        <style>
            body {
                /* background-color: #181818; */
                /* color: white; */
                text-align: center;
            }

            .cover {
                width: 100%;
                height: 200px;
                background: url('{{ asset('storage/photos/' . $ch->bgimage) }}') center/cover no-repeat;
                border-radius: 30px;
            }

            .profile-img {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                margin-top: -60px;
                border: 4px solid #181818;
            }

            .video-link {
                text-decoration: none;
                color: inherit;
            }

            .video-card {
                background: #181818;
                border-radius: 15px;
                overflow: hidden;
                transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
                position: relative;
            }

            .video-card:hover {
                transform: scale(1.05);
                box-shadow: 0 10px 20px rgba(255, 255, 255, 0.1);
            }

            .video-thumbnail {
                position: relative;
                overflow: hidden;
                border-radius: 15px;
            }

            .video-player {
                width: 100%;
               
            aspect-ratio: 1/1;
            /* يحافظ على الصورة مربعة */
            object-fit: cover;
                border-radius: 15px;
            }

            .video-player:hover {
                filter: brightness(0.8);
            }

            .video-duration {
                position: absolute;
                bottom: 8px;
                right: 8px;
                background: rgba(0, 0, 0, 0.7);
                color: white;
                padding: 4px 8px;
                font-size: 14px;
                border-radius: 5px;
            }

            .video-info {
                padding: 10px;
            }

            .video-title {
                font-size: 16px;
                font-weight: bold;
                color: #fff;
                margin: 5px 0;
            }

            .video-meta {
                font-size: 14px;
                color: #bbb;
            }
        </style>
    @endsection
    {{-- <div dir="rtl"
        style="width: 100%; height: 400px;background-attachment: fixed;background-size: cover;background-repeat: no-repeat;background-image: url({{ asset('storage/photos/' . $ch->bgimage) }});">
        <div style="width: 100%; height: 400px; background-image: linear-gradient(2deg, #ffffff, transparent);">
           
            
        </div>
    </div> --}}

    {{-- <div class="section" dir="rtl">
        <div class="container">
            {{-- <div class="row p-2" style="align-items: flex-end;display: flex;" style="width: 100%;">
                <div class=" col-12">
                    <img src="{{asset('storage/photos/'.$ch->image)}}" style="width: 200px; height: 200px; border-radius: 50%;border: 1px solid #000000;" alt="">
                </div>

                <div class="col-lg-6 col-sm-4 col-12 m-3" >

                    <h1 class="text-dark">{{$ch->name}}</h1>
                    <p class="text-dark"><i class="fa fa-user"></i> {{$ch->subscription}}  <i class="fa fa-video-camera"></i> {{count($video)}} </p>
                    <p>{{$ch->desc}}</p>
                </div>

                <div class=" col-12">
                    
                        @if ($Part)
                            @if ($Part->stute == 1)
                            <center>
                                <button wire:click='Participants' class=" m-1 btn btn-info fa fa-bell"> الغاء الاشتراك ب القناة</button>
                            </center> 
                            @else
                            <center>
                                <button wire:click='Participants' class=" m-1 btn btn-danger fa fa-bell"> الاشتراك ب القناة</button>
                            </center>
                            @endif
                        @else
                            <center>
                                <button wire:click='Participants' class=" m-1 btn btn-danger fa fa-bell"> الاشتراك ب القناة</button>
                            </center>
                        @endif
                    
                </div>
            </div> --}}
    <div class="section" dir="rtl">
        <div class="container mt-4">
            <!-- صورة الغلاف -->
            <div class="cover"></div>

            <!-- صورة البروفايل والمعلومات -->
            <div class="text-center mt-3">
                <img src="{{ asset('storage/photos/' . $ch->image) }}" class="profile-img" alt="Profile">
                <h2 class="mt-2">{{ $ch->name }}</h2>
                <p class="text-muted"> {{ $ch->subscription }} مشترك • {{ count($video) }} فيديو</p>
                <p><a href="{{ route('Openc', ['id' => $ch->uname]) }}"
                        class="text-primary text-decoration-none">{{ $ch->uname }} </a></p>

                <!-- زر الاشتراك -->

                @if ($Part)
                    @if ($Part->stute == 1)
                        <center>
                            <button wire:click='Participants' class="btn btn-light fw-bold">✅ مشترك</button>
                            {{-- <button  class=" m-1 btn btn-info fa fa-bell"> الغاء الاشتراك ب القناة</button> --}}
                        </center>
                    @else
                        <center>
                            <button wire:click='Participants' class="btn btn-light fw-bold">الاشتراك ب القناة</button>

                            {{-- <button wire:click='Participants' class=" m-1 btn btn-danger fa fa-bell"> الاشتراك ب القناة</button> --}}
                        </center>
                    @endif
                @else
                    <center>
                        <button wire:click='Participants' class="btn btn-light fw-bold">الاشتراك ب القناة</button>

                        {{-- <button wire:click='Participants' class=" m-1 btn btn-danger fa fa-bell"> الاشتراك ب القناة</button> --}}
                    </center>
                @endif

            </div>
        </div>
    </div>

    <hr>
    <div class="container mt-4">
        @if (count($video) > 0)
            <div class="row">
                <!-- بطاقة الفيديو -->
                <h2>فيديوهات القناة</h2>
                @foreach ($video as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                        <a href="{{ route('Openv', ['id' => $item->uname]) }}" class="video-link">
                            <div class="video-card">
                                <div class="video-thumbnail">
                                    <video wire:ignore id="video_{{ $item->uname }}" class="video-player"
                                        src="{{ asset('storage/videos/' . $item->video) }}"></video>
                                    <div class="video-duration">
                                        <span wire:model.defer="durations.{{ $item->uname }}">تحميل...</span>
                                    </div>
                                </div>
                                <div class="video-info">
                                    <h5 class="video-title">{{ $item->name }}</h5>
                                    <p class="video-meta">👁️ {{ $item->watch_num ?? 0 }} مشاهدة •
                                        {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <center>
                <h3>
                    لا يوجد مقاطع فيديو بعد
                </h3>
            </center>
        @endif
    </div>
    {{-- <div class="section">
        <div class="container">
            @if (count($video) > 0)
                <div class="row p-1">
                    @foreach ($video as $item)
                        <div class="col-lg-4 col-12">
                            <a href="{{ route('Openv', ['id' => $item->uname]) }}" style="text-decoration: none">
                                <div dir="rtl" class="card m-1">
                                    <div class="videocard">
                                        <video style="height: 250px;width: 100%;"
                                            src="{{ asset('storage/videos/' . $item->video) }}"
                                            class="card-img-top videorun "></video>

                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->name }}</h5>
                                        <p><i class="fa fa-eye"> {{ $item->watch_num ?? 0 }}</i> <i
                                                class="fa fa fa-thumbs-up"> {{ $item->like_num ?? 0 }}</i></p>

                                        <p>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                                        <p class="card-text">{{ $item->summary }}</p>
                                        <div class="row">
                                            <div class="col-md-6 col-12" style="display: flex">
                                                <i class="fa fa-eye m-1"></i>
                                                <p class="m-1">{{ $item->watch_num }}</p>
                                            </div>
                                            <div class="col-md-6 col-12" style="display: flex">
                                                <i class="fa fa-video-camera m-1"></i>
                                                <p class="m-1">{{ $item->types->name ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <center>
                    <h3>
                        لا يوجد مقاطع فيديو بعد
                    </h3>
                </center>
            @endif
        </div>
    </div> --}}



</div>

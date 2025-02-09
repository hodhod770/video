@extends('layouts.Out')
@section('con')
    @php
        Carbon\Carbon::setLocale('ar');
    @endphp
    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <center>
                <h1>قنوات شائعة</h1>
            </center>

            <div dir="rtl" class="row d-flex flex-wrap justify-content-center">
                @foreach ($channels3 as $item)
                    <div class="col-md-2 col-4 d-flex flex-column align-items-center" style="height: 350px;">
                        <a href="{{ route('Openc', ['id' => $item->uname]) }}">
                            <img src="{{ asset('storage/photos/' . $item->image) }}" class="profile-img" alt="">

                        </a>
                        <a class="p-2 m-1 text-center flex-grow-1 d-flex flex-column justify-content-between"
                            href="{{ route('Openc', ['id' => $item->uname]) }}" style="text-decoration: none; width: 100%;">
                            <div class="card profile-card">
                                <h3 class="text-dark">{{ $item->name }}</h3>
                                <p class="text-dark"><i class="fa fa-user"></i> {{ $item->subscription }} </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <center>
                <a href="{{ route('Listchannel') }}">عرض كل القنوات</a>
            </center>
        </div>
    </div>

    <!-- /SECTION -->
    <hr>
@section('newstyle')
    <style>
        /* تصميم بطاقة الفيديو */
        .video-card {
            border: none;
            overflow: hidden;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #1f1f1f;
        }

        .video-card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        /* منطقة الصورة/الفيديو */
        .video-thumbnail {
            position: relative;
            overflow: hidden;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* يمنع القص ويعرض الفيديو بالكامل */
            aspect-ratio: 16/9; /* أو أي نسبة تناسب أبعاد الفيديو */
        }

        .video-thumbnail video {
            object-fit: cover;
            width: 100%;
            height: 250px;
            transition: opacity 0.3s ease;
        }

        .video-thumbnail video:hover {
            opacity: 0.9;
        }

        /* عرض مدة الفيديو */
        .video-duration {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.75);
            color: #fff;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        /* معلومات الفيديو */
        .video-info {
            padding: 10px 15px;
        }

        .video-info h5 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: bold;
            color: #fff;
        }

        .video-info p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: #ccc;
        }

        /* إحصائيات الفيديو */
        .video-stats {
            margin-top: 8px;
            font-size: 0.85rem;
            color: #bbb;
        }

        .video-stats i {
            margin-right: 4px;
        }

        /* رابط البطاقة بدون تحته خط */
        .video-link {
            text-decoration: none;
            color: inherit;
        }

        .profile-img {
            width: 100%;
            aspect-ratio: 1/1;
            /* يحافظ على الصورة مربعة */
            object-fit: cover;
            /* يمنع التشوه */
            border-radius: 50%;
            /* يجعل الصورة دائرية */
            border: 1px solid #000;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .card {
            flex-grow: 1;
            border: none;
            /* يضمن تساوي جميع البطاقات */
        }

        .profile-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 10px;
            /* تقليل المسافة بين الصورة والنص */
            min-height: 100px;
            /* يجعل كل البطاقات بنفس الطول */
        }
    </style>
@endsection
<div class="section">
    <div class="container">
        <div class="row p-1">
            @foreach ($Videws20 as $item)
                <div class="col-md-4 col-12 mb-4">
                    <a href="{{ route('Openv', ['id' => $item->uname]) }}" class="video-link">
                        <div class="card video-card">
                            <div class="video-thumbnail">
                                <video id="video_{{ $item->uname }}"
                                    src="{{ asset('storage/videos/' . $item->video) }}" muted playsinline
                                    preload="metadata" class="videorun">
                                </video>


                                <!-- سيتم تحديث مدة الفيديو عبر JavaScript -->
                                <div class="video-duration">
                                    <span id="duration_video_{{ $item->uname }}">00:00</span>
                                </div>
                            </div>
                            <div class="card-body video-info" dir="rtl">
                                <h5>{{ $item->name }}</h5>
                                <p>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($item->summary, 70) }}</p>
                                <div class="video-stats d-flex justify-content-between">
                                    <div>
                                        <i class="fa fa-eye"></i> {{ $item->watch_num ?? 0 }}
                                    </div>
                                    <div>
                                        <i class="fa fa-thumbs-up"></i> {{ $item->like_num ?? 0 }}
                                    </div>
                                    <div>
                                        <i class="fa fa-video-camera"></i> {{ $item->types->name ?? '' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            @section('newjs')
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let videos = document.querySelectorAll("video");

                        videos.forEach(video => {
                            video.addEventListener("loadedmetadata", function() {
                                let durationElement = document.getElementById(`duration_${video.id}`);
                                if (durationElement) {
                                    durationElement.textContent = formatTime(video.duration);
                                }
                            });
                        });

                        function formatTime(seconds) {
                            let min = Math.floor(seconds / 60);
                            let sec = Math.floor(seconds % 60);
                            return `${min}:${sec < 10 ? '0' : ''}${sec}`;
                        }
                    });
                </script>
            @endsection

        </div>
    </div>
</div>






<!-- NEWSLETTER -->

<!-- /NEWSLETTER -->

{{-- <script>
			document.addEventListener('DOMContentLoaded', function () {
				const video = document.querySelector('.videorun');
				const card = document.querySelector('.card');

				// Play video on hover (for desktop)
				card.addEventListener('mouseenter', function () {
					video.play();
				});

				card.addEventListener('mouseleave', function () {
					video.pause();
				});

				// Play video when card is in the middle of the screen (for Android)
				function checkVideoInView() {
					const rect = card.getBoundingClientRect();
					const viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
					const middleOfScreen = viewHeight / 2;

					if (rect.top <= middleOfScreen && rect.bottom >= middleOfScreen) {
						video.play();
					} else {
						video.pause();
					}
				}

				window.addEventListener('scroll', checkVideoInView);
				window.addEventListener('resize', checkVideoInView);
		});

</script> --}}
@endsection

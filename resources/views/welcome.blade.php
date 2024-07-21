@extends('layouts.Out')
@section('con')
@php
Carbon\Carbon::setLocale('ar');
@endphp
    <!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<center>
					<h1>قنوات شائعة</h1>
				</center>
				<!-- row -->
				<div dir="rtl" class="row">
					<!-- shop -->
					@foreach ($channels3 as $item)
					<div  class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="clips">

							</div>
							<div class="shop-img">
								<img  style="height: 350px" src="{{asset('storage/photos/'.$item->image)}}" alt="">
							</div>
							<div class="shop-body">
								<h3>{{$item->name}}</h3>
								<a href="{{route('Openc',['id'=>$item->uname])}}" class="cta-btn">زيارة القناة <i class="fa fa-arrow-circle-left"></i></a>
							</div>
						</div>
					</div>
					@endforeach
					<!-- /shop -->

					<center>
						<a href="{{route('Listchannel')}}">عرض كل القنوات</a>
					</center>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		<hr>
		<div class="section" >
			<div class="container">
				<div class="row p-1">
					@foreach ($Videws20 as $item)
					<div class="col-md-4 col-12">
						<a href="{{route('Openv',['id'=>$item->uname])}}" style="text-decoration: none">
							<div dir="rtl" class="card m-1" style="width: 25rem;">
								<div class="videocard">
								<video style="height: 250px;width: 100%;" src="{{asset('storage/videos/'.$item->video)}}" class="card-img-top videorun "></video>
	
								</div>
								<div class="card-body" >
								  <h5 class="card-title">{{$item->name}}</h5>
								  <p><i class="fa fa-eye"> {{ $item->watch_num??0 }}</i>  <i class="fa fa fa-thumbs-up"> {{ $item->like_num??0 }}</i></p>
                
								  <p>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
								  <p class="card-text">{{$item->summary}}</p>
								  <div class="row">
									<div class="col-md-6 col-12" style="display: flex">
										<i class="fa fa-eye m-1"></i><p class="m-1">{{$item->watch_num}}</p>
									</div>
									<div class="col-md-6 col-12" style="display: flex">
										<i class="fa fa-video-camera m-1"></i><p class="m-1">{{$item->types->name??""}}</p>
									</div>
								  </div>
								</div>
							  </div>
						</a>
					</div>
					
					
					@endforeach
				</div>
			</div>
		</div>

		


    

        <!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
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
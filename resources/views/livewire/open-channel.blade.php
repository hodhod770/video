<div>
    @php
    Carbon\Carbon::setLocale('ar');
@endphp
    <div dir="rtl"
        style="width: 100%; height: 400px;background-attachment: fixed;background-size: cover;background-repeat: no-repeat;background-image: url({{ asset('storage/photos/' . $ch->bgimage) }});">
        <div style="width: 100%; height: 400px; background-image: linear-gradient(2deg, #ffffff, transparent);">
           
            
        </div>
    </div>

    <div class="section" dir="rtl">
        <div class="container">
            <div class="row p-2" style="align-items: flex-end;display: flex;" style="width: 100%;">
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
                            @if ($Part->stute==1)
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
            </div>
        </div>
    </div>

    <hr>
		<div class="section" >
			<div class="container">
				@if (count($video)>0)
                <div class="row p-1">
					@foreach ($video as $item)
					<div class="col-lg-6 col-12">
						<a href="{{route('Openv',['id'=>$item->uname])}}" style="text-decoration: none">
							<div dir="rtl" class="card m-1" style="width: 20rem;">
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
                @else
                    <center>
                        <h3>
                            لا يوجد مقاطع فيديو بعد
                        </h3>
                    </center>
                @endif
			</div>
		</div>



</div>

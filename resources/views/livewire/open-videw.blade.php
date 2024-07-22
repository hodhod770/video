<div>
    @php
        Carbon\Carbon::setLocale('ar');
    @endphp
    <div class="section" dir="rtl">

        <div class="row p-1">
            <div class="col-md-8 col-12">
                <div style="width: 100%; height: 600px;" wire:ignore.self>

                    <video controls autoplay style="width: 100%;height: 100%"
                        src="{{ asset('storage/videos/' . $vi->video) }}"></video>




                </div>
                <h1>{{ $vi->name }}</h1>
                <p><i class="fa fa-eye"> {{ $vi->watch_num??0 }}</i>  <i class="fa fa fa-thumbs-up"> {{ $vi->like_num??0 }}</i> <i class="fa fa-date">{{ Carbon\Carbon::parse($vi->created_at)->diffForHumans() }}</i></p>

                <div class="row">
                    <div class="col-md-4 col-6">
                       @if ($feel)
                            @if ($feel->feel==0)
                            <button class=" m-1 btn btn-primary fa fa-thumbs-up" wire:click='editefeel(1)'> اعجاب</button>
                            <button class=" m-1 btn btn-primary fa fa-thumbs-down" wire:click='editefeel(2)'> سيئ</button>
                            @elseif($feel->feel==1)
                            <button class=" m-1 btn btn-success fa fa-thumbs-up" wire:click='editefeel(0)'> تم تسجيل اعجابك </button>
                            <button class=" m-1 btn btn-primary fa fa-thumbs-down" wire:click='editefeel(2)'> سيئ</button>
                            @elseif($feel->feel==2)
                            <button class=" m-1 btn btn-primary fa fa-thumbs-up" wire:click='editefeel(1)'> اعجاب</button>
                            <button class=" m-1 btn btn-danger fa fa-thumbs-down" wire:click='editefeel(0)'> تم تسجيل استيائك </button>
                            @endif
                       @else
                       <button class=" m-1 btn btn-primary fa fa-thumbs-up" wire:click='editefeel(1)'> اعجاب</button>
                       <button class=" m-1 btn btn-primary fa fa-thumbs-down" wire:click='editefeel(2)'> سيئ</button>
                       @endif
                    </div>
                    <div class="col-md-4 col-0">
                        <center>
    
                        </center>
                    </div>
                    <div class="col-md-4 col-6" >
                      
                        
                        <div style="display: flex;flex-wrap: wrap;align-content: flex-start;justify-content: flex-start;align-items: flex-end;flex-direction: row;margin: 41pz;">
                            <img style="border-radius: 50%;width: 50px; height: 50px;"  src="{{asset('storage/photos/'.$vi->channle->image)}}" alt="">
                        
                        
                            <p style="margin: 17px">{{$vi->channle->name}}</p>
                        
                        </div>
                        <button class=" m-1 btn btn-danger fa fa-bell"> الاشتراك ب القناة</button>
                       
                    </div>

                </div>
                


                
                
                <p>{{ $vi->summary }}</p>
                <p>{{ $vi->description }}</p>

                <div style="height: 50px"></div>
                <hr>
                <div class="row">
                    <div class="col-12 p-2 m-2">
                        <form wire:submit='Sendcommet' method="post">
                            <div class="input-group">
                                <input wire:model='texts' placeholder="اكتب تعليقك هنا ...." type="text" class="form-control" name="" id="">
                                <div class="input-group-append" style="height: 100%">
                                    <button type="submit" class="btn btn-primary fa fa-send"> ارسال</button>
                                </div>
                            </div>
                            @error('texts')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </form>

                    </div>

                @foreach ($comment as $item)
                        <div class="col-md-6 col-12">
                            <div class="row">
                                <div class="col-4"
                                style="display: flex;
                                            flex-direction: column;
                                            
                                            align-items: center;
                                            justify-content: flex-start;
                                            flex-wrap: nowrap;">
                                <img style="width: 50px; height: 50px;" src="{{ asset('person.png') }}" alt="">
                                <br>
                                <h6 style="transform: translateY(-27px);">{{ $item->user->name??"" }}</h6>
                            </div>

                            <div class="col-8" style="text-align: center">
                                {{ $item->texts }}
                            </div>
                            </div>
                            <hr>
                        </div>
                        @endforeach
                    </div>
            </div>

            <div class="col-md-4 col-12">
                @foreach ($likesv as $item)
                    <a href="{{ route('Openv', ['id' => $item->uname]) }}" style="text-decoration: none">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <video style="width: 100%;height: 150px;object-fit: cover"
                                        src="{{ asset('storage/videos/' . $item->video) }}"></video>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->name??"" }}</h5>
                                        <p class="card-text">{{ $item->summary??"" }}</p>
                                        <p class="card-text"><small
                                                class="text-muted">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>

    </div>
</div>

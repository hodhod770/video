@extends('layouts.Out')
@section('con')
<div class="section">
    @php
Carbon\Carbon::setLocale('ar');
@endphp
    <!-- container -->
    <div dir="rtl" class="m-3">
        @foreach ($results as $item)
        <a href="{{ route('Openv', ['id' => $item->uname]) }}" style="text-decoration: none">
            <div class="card mb-3" >
                <div class="row g-0">
                    <div class="col-md-4">
                        <video style="width: 100%;height: 300px;object-fit: cover"
                            src="{{ asset('storage/videos/' . $item->video) }}"></video>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
						     <p><i class="fa fa-eye"> {{ $item->watch_num??0 }}</i>  <i class="fa fa fa-thumbs-up"> {{ $item->like_num??0 }}</i></p>

                            <p class="card-text">{{ $item->summary }}</p>
                            <p class="card-text"><small
                                    class="text-muted">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                            </p>
						<i class="fa fa-video-camera m-1"><p class="m-1">{{$item->types->name??""}}</p></i>

                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
    </div>
</div>
@endsection
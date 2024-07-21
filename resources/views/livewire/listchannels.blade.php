<div>
    <div class="section" dir="rtl">
        <div class="container">
            <div class="row">
                <h3>القنوات</h3>
                @foreach ($channels as $item)
                   <a class="p-2 m-1" href="{{route('Openc',['id'=>$item->uname])}}" style="text-decoration: none;width: 220px">
                    <div class="card" >

                        <img src="{{ asset('storage/photos/' . $item->image) }}"
                            style="width: 200px; height: 200px; border-radius: 50%;border: 1px solid #000000;"
                            alt="">



                        <center>
                            <h3 class="text-dark">{{ $item->name }}</h3>
                            <p class="text-dark"><i class="fa fa-user"></i> {{ $item->subscription }} </p>
                            {{-- <p>{{$item->desc}}</p> --}}
                        </center>

                    </div>
                   </a>
                @endforeach
            </div>
            <center>
                <button wire:click='incr' class="btn btn-primary">المزيد</button>

            </center>
        </div>
    </div>
</div>

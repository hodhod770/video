<div>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
    <script type="text/javascript">
        window.tailwind.config = {
            darkMode: ['class'],
            theme: {
                extend: {
                    colors: {
                        border: 'hsl(var(--border))',
                        input: 'hsl(var(--input))',
                        ring: 'hsl(var(--ring))',
                        background: 'hsl(var(--background))',
                        foreground: 'hsl(var(--foreground))',
                        primary: {
                            DEFAULT: 'hsl(var(--primary))',
                            foreground: 'hsl(var(--primary-foreground))'
                        },
                        secondary: {
                            DEFAULT: 'hsl(var(--secondary))',
                            foreground: 'hsl(var(--secondary-foreground))'
                        },
                        destructive: {
                            DEFAULT: 'hsl(var(--destructive))',
                            foreground: 'hsl(var(--destructive-foreground))'
                        },
                        muted: {
                            DEFAULT: 'hsl(var(--muted))',
                            foreground: 'hsl(var(--muted-foreground))'
                        },
                        accent: {
                            DEFAULT: 'hsl(var(--accent))',
                            foreground: 'hsl(var(--accent-foreground))'
                        },
                        popover: {
                            DEFAULT: 'hsl(var(--popover))',
                            foreground: 'hsl(var(--popover-foreground))'
                        },
                        card: {
                            DEFAULT: 'hsl(var(--card))',
                            foreground: 'hsl(var(--card-foreground))'
                        },
                    },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --background: 0 0% 100%;
                --foreground: 240 10% 3.9%;
                --card: 0 0% 100%;
                --card-foreground: 240 10% 3.9%;
                --popover: 0 0% 100%;
                --popover-foreground: 240 10% 3.9%;
                --primary: 240 5.9% 10%;
                --primary-foreground: 0 0% 98%;
                --secondary: 240 4.8% 95.9%;
                --secondary-foreground: 240 5.9% 10%;
                --muted: 240 4.8% 95.9%;
                --muted-foreground: 240 3.8% 46.1%;
                --accent: 240 4.8% 95.9%;
                --accent-foreground: 240 5.9% 10%;
                --destructive: 0 84.2% 60.2%;
                --destructive-foreground: 0 0% 98%;
                --border: 240 5.9% 90%;
                --input: 240 5.9% 90%;
                --ring: 240 5.9% 10%;
                --radius: 0.5rem;
            }

            .dark {
                --background: 240 10% 3.9%;
                --foreground: 0 0% 98%;
                --card: 240 10% 3.9%;
                --card-foreground: 0 0% 98%;
                --popover: 240 10% 3.9%;
                --popover-foreground: 0 0% 98%;
                --primary: 0 0% 98%;
                --primary-foreground: 240 5.9% 10%;
                --secondary: 240 3.7% 15.9%;
                --secondary-foreground: 0 0% 98%;
                --muted: 240 3.7% 15.9%;
                --muted-foreground: 240 5% 64.9%;
                --accent: 240 3.7% 15.9%;
                --accent-foreground: 0 0% 98%;
                --destructive: 0 62.8% 30.6%;
                --destructive-foreground: 0 0% 98%;
                --border: 240 3.7% 15.9%;
                --input: 240 3.7% 15.9%;
                --ring: 240 4.9% 83.9%;
            }
        }
    </style>
    @php
        Carbon\Carbon::setLocale('ar');
    @endphp
    <div class="flex flex-col bg-background text-foreground min-h-screen" dir="rtl">
        <div class="flex flex-col lg:flex-row">
            <div class="lg:w-2/3 p-4">
                <video class="w-full rounded-lg" style="width: 100%;height: 600px;" controls>
                    <source src="{{ asset('storage/videos/' . $vi->video) }}" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
                <div class="mt-4">
                    <h1 class="text-xl lg:text-2xl font-bold">{{ $vi->name }}</h1>
                    <div class="flex items-center mt-2">
                        <img src="{{ asset('storage/photos/' . $vi->channle->image) }}"
                            style="width: 40px; height: 40px;" alt="Channel Logo" class="rounded-full mr-2" />
                        <div>
                            <p class="font-semibold"> {{ $vi->channle->name }} </p>
                            <p class="text-muted">
                                @php
                                    $Partcount = count($Partcount);
                                    $formattedCount =
                                        $Partcount >= 1000000
                                            ? number_format($Partcount / 1000000, 1) . 'M'
                                            : ($Partcount >= 1000
                                                ? number_format($Partcount / 1000, 1) . 'K'
                                                : $Partcount);
                                @endphp
                                {{ $formattedCount }} مشترك
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row justify-between mt-4">
                        <div>
                            {{-- <button class="bg-light text-secondary-foreground p-2 rounded-md">اشتراك</button> --}}

                            @if ($Part)
                                @if ($Part->stute == 1)
                                    <button wire:click='Participants'
                                        class="bg-light text-secondary-foreground p-2 rounded-md">الغاء اشتراك </button>
                                @else
                                    <button wire:click='Participants'
                                        class="bg-light text-secondary-foreground p-2 rounded-md">اشتراك</button>
                                @endif
                            @else
                                <button wire:click='Participants'
                                    class="bg-light text-secondary-foreground p-2 rounded-md">اشتراك</button>

                            @endif
                        </div>
                        @php
                            $Partcountlike = $vi->like_num ?? 0;
                            $formattedCountlike =
                                $Partcountlike >= 1000000
                                    ? number_format($Partcountlike / 1000000, 1) . 'M'
                                    : ($Partcountlike >= 1000
                                        ? number_format($Partcountlike / 1000, 1) . 'K'
                                        : $Partcountlike);
                        @endphp
                        <div class="flex items-center mt-2 lg:mt-0">

                            @if ($feel)
                                @if ($feel->feel == 0)
                                    <button wire:click='editefeel(1)'
                                        class="p-2 hover:bg-muted rounded-md">👍{{ $formattedCountlike ?? 0 }}</button>
                                    <button wire:click='editefeel(2)' class="p-2 hover:bg-muted rounded-md"> <i
                                            class="fa fa-thumbs-down"></i></button>
                                @elseif($feel->feel == 1)
                                    <button wire:click='editefeel(0)'
                                        class="p-2 bg-light  rounded-md">👍{{ $formattedCountlike ?? 0 }}</button>
                                    <button wire:click='editefeel(2)' class="p-2 hover:bg-muted rounded-md"> <i
                                            class="fa fa-thumbs-down"></i></button>
                                @elseif($feel->feel == 2)
                                    <button wire:click='editefeel(1)'
                                        class="p-2  thover:bg-muted rounded-md">👍{{ $formattedCountlike ?? 0 }}</button>
                                    <button wire:click='editefeel(0)' class="p-2 bg-light rounded-md"> <i
                                            class="fa fa-thumbs-down"></i></button>
                                @endif
                            @else
                                <button wire:click='editefeel(1)'
                                    class="p-2 hover:bg-muted rounded-md">👍{{ $formattedCountlike ?? 0 }}</button>
                                <button wire:click='editefeel(2)' class="p-2 hover:bg-muted rounded-md"> <i
                                        class="fa fa-thumbs-down"></i></button>
                            @endif

                            <button class="p-2 hover:bg-muted rounded-md ml-2">مشاركة</button>
                            <a href="{{ asset('storage/videos/' . $vi->video) }}" download
                                class="p-2 hover:bg-muted rounded-md ml-2">تنزيل</a>


                        </div>
                    </div>

                    @php
                        $Partcountwatch = $vi->watch_num ?? 0;
                        $formattedCountwatch =
                            $Partcountwatch >= 1000000
                                ? number_format($Partcountwatch / 1000000, 1) . 'M'
                                : ($Partcountwatch >= 1000
                                    ? number_format($Partcountwatch / 1000, 1) . 'K'
                                    : $Partcountwatch);
                    @endphp
                    <p class="mt-2 text-muted"> {{ $vi->watch_num ?? 0 }} مشاهدات •
                        {{ Carbon\Carbon::parse($formattedCountwatch)->diffForHumans() }}</p>
                </div>

                <div class="bg-background p-4 rounded-lg shadow-md">
                    {{-- <div class="text-muted-foreground mb-2"><span>77K views</span> • <span>1 year ago</span></div> --}}
                    <h2 class="text-lg font-bold">
                        <p>{{ $vi->summary }}</p>
                        <p>{{ $vi->description }}</p>
                    </h2>
                    <div class="mt-4">
                        <span class="text-muted">{{ count($comment) }} التعليقات</span>
                        {{-- <button
                            class="bg-secondary text-secondary-foreground hover:bg-secondary/80 ml-2 p-1 rounded">Sort
                            by</button> --}}

                        <form wire:submit='Sendcommet' method="post">
                            <div class="input-group">
                                <input wire:model='texts' placeholder="اكتب تعليقك هنا ...." type="text"
                                    class="form-control" name="" id="">
                                <div class="input-group-append" style="height: 100%">
                                    <button type="submit" class="m-2 p-3 btn btn-primary fa fa-send"> ارسال</button>
                                </div>
                            </div>
                            @error('texts')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </form>
                    </div>
                    <div class="mt-4 border-t border-border pt-4">
                        @foreach ($comment as $item)
                                            {{-- <a href="{{ route('Openv', ['id' => $item->uname]) }}" style="text-decoration: none"> --}}

                            <div class="mb-4">
                                <div class="flex items-center">
                                    <img src="{{ asset('person.png') }} " alt="User Avatar"
                                        class="w-8 h-8 rounded-full mr-2" />
                                    <span class="font-bold">{{$item->user->name ?? ''}}</span>
                                    <span class="text-muted-foreground ml-2">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                </div>
                                <p class="text-muted-foreground" >{{ $item->texts }}</p>
                                <div class="text-muted mt-1">
                                    {{-- <span>99</span> <button class="text-muted hover:text-muted/80">Reply</button> --}}
                                    {{-- <span class="ml-2">2 replies</span> --}}
                                </div>
                            </div>
                            
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="lg:w-1/3 p-4 overflow-y-auto">
                <h2 class="text-lg lg:text-xl font-bold">الفيديوهات المشابهة </h2>
                <div class="mt-4">
                    @foreach ($likesv as $item)
                        {{-- <a href="{{ route('Openv', ['id' => $item->uname]) }}" style="text-decoration: none"> --}}

                        @php
                            $Partcountwatch = $item->watch_num ?? 0;
                            $formattedCountwatch =
                                $Partcountwatch >= 1000000
                                    ? number_format($Partcountwatch / 1000000, 1) . 'M'
                                    : ($Partcountwatch >= 1000
                                        ? number_format($Partcountwatch / 1000, 1) . 'K'
                                        : $Partcountwatch);
                        @endphp
                        <a href="{{ route('Openv', ['id' => $item->uname]) }}" style="text-decoration: none">

                        <div class="flex flex-col lg:flex-row items-center mb-4">
                            <video style="width: 50%;height: 150px;object-fit: cover"
                                        src="{{ asset('storage/videos/' . $item->video) }}"></video>
                            <div>
                                <p class="font-semibold">{{ $item->name ?? '' }}</p>
                                <p class="text-muted">{{ $formattedCountwatch }} مشاهدات •
                                    {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>




















{{--    <div class="section" dir="rtl">

        <div class="row p-1">
            <div class="col-md-8 col-12">
                <div style="width: 100%; height: 600px;" wire:ignore.self>

                    <video controls autoplay style="width: 100%;height: 100%"
                        src="{{ asset('storage/videos/' . $vi->video) }}"></video>
                </div>
                <h1>{{ $vi->name }}</h1>
                <p><i class="fa fa-eye"> {{ $vi->watch_num ?? 0 }}</i> <i class="fa fa fa-thumbs-up">
                        {{ $vi->like_num ?? 0 }}</i> <i
                        class="fa fa-date">{{ Carbon\Carbon::parse($vi->created_at)->diffForHumans() }}</i></p>

                <div class="row">

                    <div class="col-md-4 col-6">
                        @if ($feel)
                            @if ($feel->feel == 0)
                                <button class=" m-1 btn btn-primary fa fa-thumbs-up" wire:click='editefeel(1)'>
                                    اعجاب</button>
                                <button class=" m-1 btn btn-primary fa fa-thumbs-down" wire:click='editefeel(2)'>
                                    سيئ</button>
                            @elseif($feel->feel == 1)
                                <button class=" m-1 btn btn-success fa fa-thumbs-up" wire:click='editefeel(0)'> تم تسجيل
                                    اعجابك </button>
                                <button class=" m-1 btn btn-primary fa fa-thumbs-down" wire:click='editefeel(2)'>
                                    سيئ</button>
                            @elseif($feel->feel == 2)
                                <button class=" m-1 btn btn-primary fa fa-thumbs-up" wire:click='editefeel(1)'>
                                    اعجاب</button>
                                <button class=" m-1 btn btn-danger fa fa-thumbs-down" wire:click='editefeel(0)'> تم
                                    تسجيل استيائك </button>
                            @endif
                        @else
                            <button class=" m-1 btn btn-primary fa fa-thumbs-up" wire:click='editefeel(1)'>
                                اعجاب</button>
                            <button class=" m-1 btn btn-primary fa fa-thumbs-down" wire:click='editefeel(2)'>
                                سيئ</button>
                        @endif
                    </div>
                    <div class="col-md-4 col-0">
                        <center>

                        </center>
                    </div>
                    <div class="col-md-4 col-6">


                        <div
                            style="display: flex;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;margin: 41pz;flex-direction: row;">
                            <img style="border-radius: 50%;width: 50px; height: 50px;"
                                src="{{ asset('storage/photos/' . $vi->channle->image) }}" alt="">


                            <p style="margin: 17px">{{ $vi->channle->name }}</p>


                        </div>
                        @if ($Part)
                            @if ($Part->stute == 1)
                                <center>
                                    <button wire:click='Participants' class=" m-1 btn btn-info fa fa-bell"> الغاء
                                        الاشتراك ب القناة</button>
                                </center>
                            @else
                                <center>
                                    <button wire:click='Participants' class=" m-1 btn btn-danger fa fa-bell"> الاشتراك ب
                                        القناة</button>
                                </center>
                            @endif
                        @else
                            <center>
                                <button wire:click='Participants' class=" m-1 btn btn-danger fa fa-bell"> الاشتراك ب
                                    القناة</button>
                            </center>
                        @endif


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
                                <input wire:model='texts' placeholder="اكتب تعليقك هنا ...." type="text"
                                    class="form-control" name="" id="">
                                <div class="input-group-append" style="height: 100%">
                                    <button type="submit" class="btn btn-primary fa fa-send"> ارسال</button>
                                </div>
                            </div>
                            @error('texts')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </form>

                    </div>


                </div>





                <div style="height: 50px"></div>
                <hr>
                <div class="row">
                    @foreach ($comment as $item)
                        <div class="col-md-6 col-12">
                            <div class="row">
                                <div class="col-4"
                                    style="display: flex;
                                            flex-direction: column;
                                            
                                            align-items: center;
                                            justify-content: flex-start;
                                            flex-wrap: nowrap;">
                                    <img style="width: 50px; height: 50px;" src="{{ asset('person.png') }}"
                                        alt="">
                                    <br>
                                    <h6 style="transform: translateY(-27px);">{{ $item->user->name ?? '' }}</h6>
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
                                        <h5 class="card-title">{{ $item->name ?? '' }}</h5>
                                        <p class="card-text">{{ $item->summary ?? '' }}</p>
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

    </div> --}}

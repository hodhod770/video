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
        .video-duration {
            position: absolute;
            top: 122px;
            right: 10px;
            background: rgba(0, 0, 0, 0.75);
            color: #fff;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 0.9rem;
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
                        <img  src="{{ asset('storage/photos/' . $vi->channle->image) }}"
                            style="width: 40px; height: 40px;margin: 7px" alt="Channel Logo" class="rounded-full mr-2" />
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
            <div class="lg:w-1/3  overflow-y-auto">
                <h2 class="text-lg lg:text-xl font-bold">الفيديوهات المشابهة </h2>
                <div wire:ignore class="mt-4">
                    @foreach ($likesv as $item)
                    @php
                        $Partcountwatch = $item->watch_num ?? 0;
                        $formattedCountwatch = $Partcountwatch >= 1000000
                            ? number_format($Partcountwatch / 1000000, 1) . 'M'
                            : ($Partcountwatch >= 1000
                                ? number_format($Partcountwatch / 1000, 1) . 'K'
                                : $Partcountwatch);
                    @endphp
                
                    <a href="{{ route('Openv', ['id' => $item->uname]) }}" class="block">
                        <div class="flex flex-col lg:flex-row items-center bg-white dark:bg-gray-800 transform hover:scale-105 transition duration-300 mb-4">
                            <!-- مساحة الصورة المصغرة الموسعة (66% من العرض على الشاشات الكبيرة) -->
                            <div class="w-full lg:w-2/3">
                                <video 
                                    src="{{ asset('storage/videos/' . $item->video) }}" 
                                    class="w-full h-40 object-cover" 
                                    muted 
                                    id="video_{{ $item->uname }}" 
                                    playsinline>
                                </video>
                                <div class="video-duration">
                                    <span id="duration_video_{{ $item->uname }}">00:00</span>
                                </div>
                                
                            </div>
                           
                            <!-- معلومات الفيديو (33% من العرض على الشاشات الكبيرة) -->
                            <div class="p-2 w-full lg:w-1/3">
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $item->name ?? '' }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                    {{ $formattedCountwatch }} مشاهدات • {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach

                
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        let videos = document.querySelectorAll("video");
                    
                        videos.forEach(video => {
                            video.addEventListener("loadedmetadata", function () {
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

                </div>
            </div>
        </div>
    </div>
</div>

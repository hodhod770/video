<div dir="rtl">
    <div class="container " style="padding: 20px">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class=" col-12">
                        اسم صاحب الحساب:{{$user->name}}
                    </div>
                    <div class=" col-12">
                        البريد الالكتروني:{{$user->email}}
                    </div>
                </div>
            </div>
            <div class="col-12" style="margin: 3px">
                <center>
                    <button data-bs-toggle="modal" data-bs-target="#add" class="btn primary-btn fa fa-plus ">اضافة قناة
                        جديدة</button>
                </center>
            </div>

            @if (count($channel) > 0)
                @foreach ($channel as $item)
                    <div class="card p-2 m-2" style="width: 18rem;">
                        <img src="{{ asset('storage/photos/' . $item->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ $item->desc }}</p>
                            <a href="{{ route('showChannal', ['id' => $item->uname]) }}" class="btn btn-primary">فتح
                                القناة</a>
                        </div>
                    </div>
                @endforeach
            @else
                <center style="padding: 20px;">
                    <h1>لا يوجد قنوات حتى الان قم بأنشاء قناة</h1>
                </center>
            @endif

        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">اضافة قناة</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" wire:submit='AddChannel'>

                        <div class="p-2" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-cancel="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div x-show="uploading">
                                <progress class="progress" max="100" x-bind:value="progress"></progress>
                            </div>
                            @if (!$imageChanal)
                                <center>
                                    <img style="width: 50% ;height: 200px;" src="no.jpg" alt="no.jpg"
                                        srcset="">
                                </center>
                            @else
                                <img style="width: 50% ;height: 200px;" src="{{ $imageChanal->temporaryUrl() }}"
                                    alt="no.jpg" srcset="">
                            @endif
                            <br>
                            <label for="form-label">اختيار صورة </label>
                            <input wire:model.live='imageChanal' type="file" class="form-control" name=""
                                id="">
                                
                                @if (!$bgimageChanal)
                                <center>
                                    <img style="width: 50% ;height: 200px;" src="no.jpg" alt="no.jpg"
                                        srcset="">
                                </center>
                            @else
                                <img style="width: 50% ;height: 200px;" src="{{ $bgimageChanal->temporaryUrl() }}"
                                    alt="no.jpg" srcset="">
                            @endif
                                <br>
                                <label for="form-label">اختيار صورة غلاف</label>
                            <input wire:model.live='bgimageChanal' type="file" class="form-control" name=""
                                id="">
                            {{-- <progress max="100" value="50"></progress> --}}
                            
                            <label for="form-label">اسم القناه</label>
                            <input wire:model='name' required type="text" class="form-control" name=""
                                id="">


                            <label for="form-label">وصف عمل القناه</label>
                            <textarea wire:model='desc' name="" class="form-control" id="" cols="30" rows="3"></textarea>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">حفظ التعديلات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

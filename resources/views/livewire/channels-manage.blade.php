<div>
  <div class="card p-2">
    <div class="row">
        <div class="col-12" dir="rtl">
            <center>
                <button data-bs-toggle="modal" data-bs-target="#add" class="btn btn-primary fa fa-plus">ادراج فيديو جديد</button>
            </center>
           <div class="row">
            @foreach ($datas as $item)
            <div class="col-md-3 col-12" style="margin-top: 20px">
             <div class="card" style="width: 100%;">
                 <video  src="{{asset('storage/videos/'.$item->video)}}"  class="card-img-top" controls ></video>
                 {{-- <img src="{{asset('storage/videos/'.$item->video)}}" alt="" srcset=""> --}}
                 <div class="card-body">
                   <h5 class="card-title">{{$item->name}}</h5>
                   <p class="card-text">{{$item->summary}}</p>
                   <p class="card-text">{{$item->description}}</p>
                 </div>
                 <ul class="list-group list-group-flush" style="text-align: center">
                   <li class="list-group-item text-info" data-bs-toggle="modal" data-bs-target="#edite" wire:click='foredite({{$item->id}})'  style="cursor: pointer">تعديل البيانات</li>
                   <li wire:confirm='هل تريد حذف هذا الفيديو' wire:click='delete({{$item->id}})' class="list-group-item text-danger" style="cursor: pointer">حذف الفيديو</li>
                  
                 </ul>
                 {{-- <div class="card-body">
                   <a href="#" class="card-link">Card link</a>
                   <a href="#" class="card-link">Another link</a>
                 </div> --}}
               </div>
            </div>
             @endforeach
           </div>
        </div>
        
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
            <form method="POST" wire:submit='Store' >
              
                    <div dir="rtl" class="p-2" x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                      @if (!$video)
                       <center>      
                      <img style="width: 50% ;height: 200px;" src="no.jpg" alt="no.jpg" srcset="">
                       </center>
                       @else
                      <video style="width: 50% ;height: 200px;" src="{{$video->temporaryUrl()}}" controls></video>

                      @endif
                      <br>
                      <label for="form-label">اختيار فديو اختياري</label>
                      <input wire:model.live='video' accept="video/*" type="file" class="form-control" name="" id="">
                      {{-- <progress max="100" value="50"></progress> --}}
                      <div x-show="uploading">
                        <progress class="progress" max="100" x-bind:value="progress"></progress>
                    </div>
                      <label for="form-label">اسم الفيديو</label>
                      <input wire:model='name' required type="text" class="form-control" name="" id="">
                      <label for="form-label">فئة الفيديو</label>

                      <select class="form-select" wire:model='type'>
                        @foreach ($depts as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                      <label for="form-label"> خلاصة الفيديو</label>
                      <input wire:model='summary' required type="text" class="form-control" name="" id="">

                      <label for="form-label">وصف  الفيديو</label>
                      <textarea wire:model='desc' name="" class="form-control" id="" cols="30" rows="3"></textarea>

                      <label for="form-label">كلمات مفتاحية  </label>
                      <textarea wire:model='kayword' name="" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>
               
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">حفظ ونشر</button>
        </form>
        </div>
      </div>
    </div>
  </div>


  <div wire:ignore.self class="modal fade" id="edite" tabindex="-1" aria-labelledby="edite" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">اضافة قناة</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" wire:submit='edite'>
              
                    <div dir="rtl" class="p-2">
                    
                     
                      <label for="form-label">اسم الفيديو</label>
                      <input wire:model='name' required type="text" class="form-control" name="" id="">
                      <label for="form-label">فئة الفيديو</label>
                      <select class="form-select" wire:model='type'>
                        @foreach ($depts as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                      <label for="form-label"> خلاصة الفيديو</label>
                      <input wire:model='summary' required type="text" class="form-control" name="" id="">

                      <label for="form-label">وصف  الفيديو</label>
                      <textarea wire:model='desc' name="" class="form-control" id="" cols="30" rows="3"></textarea>

                      <label for="form-label">كلمات مفتاحية  </label>
                      <textarea wire:model='kayword' name="" class="form-control" id="" cols="30" rows="3"></textarea>
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

  {{-- <script>
    window.addEventListener('extract-thumbnail', event => {
        const videoUrl = event.detail.videoUrl;
        const thumbnailPath = event.detail.thumbnailPath;

        const video = document.createElement('video');
        video.src = videoUrl;
        video.currentTime = 1; // Capture the frame at 1 second

        video.addEventListener('loadeddata', function() {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataUrl = canvas.toDataURL('image/jpeg');
            
            // Emit a Livewire event to save the thumbnail
            Livewire.dispatch('saveThumbnail', dataUrl,thumbnailPath);
            alert(event.detail.videoUrl);
        });
    });

    document.addEventListener('livewire:init', () => {
      alert('dd');
      Livewire.dispatch('saveThumbnail', 'gg','ff');
      
    });

   
</script> --}}
</div>

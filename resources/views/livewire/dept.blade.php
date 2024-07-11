<div dir="rtl">
   <div class="card p-3 m-4">
    <h3> اضافة قسم</h3>
   <form wire:submit='Store'  method="post">
    <div class="row">
        <div class="col-12">
            <center>
                <label for="">اسم القسم</label>
                <input wire:model='name' style="width: 50%" type="text" class="form-control" name="" id="" >
                <button class="btn btn-primary m-2">حفظ</button>
            </center> 
        </div>
    </div>
   </form>
   </div>


   
    <div class="card p-3 m-4">
        <h5 class="card-header">بيانات الاقسام</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th>اسم القسم</th>
               
                <th>عمليات</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
             @foreach ($de as $item)
             <tr>
              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong> {{$item->name}} </strong></td>
              
              <td>
                <button wire:click="Senddata({{$item->id}},'{{$item->name}}')" data-bs-toggle="modal" data-bs-target="#smallModal" class="btn btn-info"><i class="bx bx-edit-alt me-1"></i></button>
                <button wire:click='Delete({{$item->id}})' class="btn btn-danger"><i class="bx bx-trash me-1"></i></button>
              </td>
            </tr>
             @endforeach
            
            </tbody>
          </table>
        </div>
      </div>


      <div wire:ignore.self dir="ltr" class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 dir="rtl" class="modal-title" id="exampleModalLabel2">تعديل</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <form wire:submit='Edite' method="post">
              <div dir="rtl" class="modal-body">
                <div class="row">
                  <div class="col mb-3">
                    <label for="nameSmall" class="form-label">الاسم</label>
                    <input wire:model='nameedite' type="text" id="nameSmall" class="form-control" placeholder="Enter Name" />
                  </div>
                </div>
               
              </div>
              <div dir="rtl" class="modal-footer">
                <button  type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  اغلاق
                </button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">حفظ التعديلات</button>
              </div>
            </form>
          </div>
        </div>
      </div>
   
</div>

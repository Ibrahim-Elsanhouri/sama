<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>صفحة التفاصيل</div>
    <div class='panel-body'>      
        <div class='form-group'>
          <label>الشخص المرسل</label>
          <p>{{$task->sender->name}}</p>
        </div>
        <div class='form-group'>
            <label>المشروع</label>
            <p>{{$task->project->name}}</p>
          </div>
          <div class='form-group'>
            <label>لعميل</label>
            <p>{{$task->project->user->name }}</p>
          </div>
          <div class='form-group'>
            <label>جوال العميل</label>
            <p>{{$task->project->user->mobile }}</p>
          </div>
      
          <div class='form-group'>
            <label>حالة التنفيذ من الموظف</label>
            @if($task->done == 0)
            <p>جاري التنفيذ 🏃</p>
@else
            <p>تم التنفيذ 👍</p>
            @endif
          </div>

          <div class='form-group'>
            <label>حالة التأكيد من الادارة</label>
            @if($task->approved == 0)
            <p>في انتظار تأكيد الادارة 🕑</p>
@else
            <p>تم التاكيد 👍</p>
            @endif
          </div>
        

      
        <!-- etc .... -->
        
      </form>
    </div>
  </div>
@endsection

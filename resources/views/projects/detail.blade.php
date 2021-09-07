<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>تفاصيل المشروع</div>
    <div class='panel-body'>      
        <div class='form-group'>
          <label>المشروع</label>
          <p>{{$project->name}}</p>
        </div>
        <div class='form-group'>
            <label>السعر </label>
            <p>{{$project->price}}</p>
          </div>
          <div class='form-group'>
            <label>الدفعات</label>
            <p>{{$project->payment}}</p>
          </div>
          <div class='form-group'>
            <label>رقم المعاملة</label>
            <p>{{$project->process_number}}</p>
          </div>
          <div class='form-group'>
            <label>نوع المشروع</label>
            <p>{{$project->type->name}}</p>
          </div>
          <div class='form-group'>
            <label>حالة المشروع</label>
            <p>{{$project->hala->name}}</p>
          </div>

          <div class='form-group'>
            <label>موقع المشروع</label>
            <p>{{$project->address}}</p>
          </div>
          <div class='form-group'>
            <label>العميل</label>
            <p>{{$project->user->name}}</p>
          </div>
          <div class='form-group'>
            <label>جوال العميل</label>
            <p>{{$project->user->mobile}}</p>
          </div>
          <div class='form-group'>
            <label>مكتب العميل</label>
            <p>{{$project->user->office->name}}</p>
          </div>
          <div class='form-group'>
            <label>تاريخ اضافة المشروع </label>
            <p>{{$project->created_at}}</p>
          </div>

          <div class='form-group'>
            <label> مرفقات المشروع </label>
            @if ($project->attachments == NULL)
<p>لا يوجد مرفقات للمشروع📑 </p>
            @else
          @foreach($project->attachments as $attachment)
          
    
    <a href="{{ $attachment->file}}" class="btn btn-primary" target="_blank">{{$attachment->name}}</a>
      @endforeach
      @endif

          </div>



        <!-- etc .... -->
        
      </form>
    </div>
  </div>
@endsection

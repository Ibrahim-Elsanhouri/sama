<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>تفاصيل المشروع</div>
    <div class='panel-body'>   
      <table class="table">
        <thead>
          <tr>
            <th scope="col">المشروع</th>
            <th scope="col">{{$project->name}}</th>
      
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">السعر</th>
            <td>{{$project->price}}</td>
     
          </tr>
          <tr>
            <th scope="row">الدفعات</th>
            <td>{{$project->payment}}</td>

          </tr>
          <tr>
            <th scope="row">رقم المعاملة</th>
            <td colspan="2">{{$project->process_number}}</td>
          </tr>

          <tr>
            <th scope="row">نوع المشروع</th>
            <td colspan="2">{{$project->type->name}}</td>
          </tr>
          <tr>
            <th scope="row"> حالة المشروع </th>
            <td colspan="2">{{$project->hala->name}}</td>
          </tr>
          <tr>
            <th scope="row">موقع المشروع</th>
            <td colspan="2">{{$project->address}}</td>
          </tr>
          <tr>
            <th scope="row">العميل</th>
            <td colspan="2">{{$project->user->name}}</td>
          </tr>



          <tr>
            <th scope="row">جوال العميل</th>
            <td colspan="2">{{$project->user->mobile}}</td>
          </tr>
          <tr>
            <th scope="row">مكتب العميل</th>
            <td colspan="2">{{$project->user->office->name}}</td>
          </tr>
          <tr>
            <th scope="row">تاريخ اضافة المشروع</th>
            <td colspan="2">{{$project->created_at}}</td>
          </tr>



        </tbody>
      </table>
      





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

<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>Edit Form</div>
    <div class='panel-body'>      
        <div class='form-group'>
          <label>اسم العميل</label>
          <p>{{$user->name}}</p>
        </div>
        <div class='form-group'>
            <label>البريد الالكتروني</label>
            <p>{{$user->email}}</p>
          </div>
          <div class='form-group'>
            <label>رقم الجوال</label>
            <p>{{$user->mobile}}</p>
          </div>
          <div class='form-group'>
            <label>المكتب المسجل</label>
            <p>{{$user->office->name}}</p>
          </div>
          <div class='form-group'>
            <label>عدد المشاريع</label>
            <p>{{$user->projects->count() }}</p>
          </div>
          <div class='form-group'>
            <label>كشف الحساب</label>
            <div class="text-center">
                <p><a href="{{ route('user.statement' , $user->id)}}" target="_blank" class="btn btn-info">كشف الحساب</a></p>

            </div>
          </div>
        <!-- etc .... -->
        
      </form>
    </div>
  </div>
@endsection

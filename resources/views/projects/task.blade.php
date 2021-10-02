<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>اضافة مهمة جديدة</div>
    <div class='panel-body'>
      <form method='post' action='{{ route('project.task')}}'>
        @csrf
        <div class='form-group'>
          <label>الشخص المنفذ</label>
<select name="to" class='form-control'>
@foreach(\App\Models\Admin::all() as $admin)
<option value="{{ $admin->id }}">{{ $admin->name}}</option>

@endforeach

</select>
</div> 
<div class='form-group'>
  <label>المهمة</label>
<select name="works_id" class='form-control'>
  @foreach(\App\Models\Work::all() as $work)
  <option value="{{ $work->id }}">{{ $work->name}}</option>
  
  @endforeach
  
  </select>

</div>
          <input type='hidden' name='from' value="{{ CRUDBooster::myId() }}"/>
          <input type='hidden' name='projects_id' value="{{ $task->project->id }}"/>
          <input type='hidden' name='users_id' value="{{ $task->project->user->id }}"/>

        </div>
         
        <!-- etc .... -->
        
    </div>
    <div class='panel-footer'>
      <input type='submit' class='btn btn-primary' value='Save changes'/>
    </div>
</form>
  </div>
@endsection
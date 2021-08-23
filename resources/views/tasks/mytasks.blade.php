<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
<!-- Your custom  HTML goes here -->
<table class='table table-striped table-bordered'>
  <thead>
      <tr>
        <th>رقم المهمة</th>
        <th>مرسل المهمة</th>
        <th>عنوان المهمة</th>
        <th> المشروع  </th>
        <th> العميل  </th>
        <th> جوال العميل  </th>
        <th> وقت ارسال المهمة</th>


        <th>  عداد المهمة</th>
        <th>  تنفيذ المهمة</th>
        <th>  تاكيد المهمة</th>

        <th>الاجرء</th>
       </tr>
  </thead>
  <tbody>
    @foreach($tasks  as $task )
      <tr>
        <td>{{$task->id }}</td>
        <td>{{$task->from_user->name }}</td>
        <td>{{$task->title}}</td>
        <td>{{$task->project->name}}</td>
        <td>{{$task->project->user->name}}</td>
        <td>{{$task->project->user->mobile}}</td>

        <td>{{$task->created_at}}</td>

        <td>{{$task->created_at->diffForHumans()}}</td>
<td>
    @if ($task->done)
    تم ارسال تاكيد المهمة 👷‍♂️
    @else 
<a href="{{ route('task.done' , $task->id)}}" class="btn btn-success">انهاء التنفيذ</a>
    @endif
</td>

<td>
    @if ($task->approved)
    تم تأكيد المهمة من الادارة 💖
    @else
    في الانتظار 🕑
    @endif
</td>
        <td>
          <!-- To make sure we have read access, wee need to validate the privilege -->
          @if(CRUDBooster::isUpdate() && $button_edit)
          <a class='btn btn-success btn-sm' href='{{CRUDBooster::mainpath("edit/$task->id")}}'>Edit</a>
          @endif
          
          @if(CRUDBooster::isDelete() && $button_edit)
          <a class='btn btn-success btn-sm' href='{{CRUDBooster::mainpath("delete/$task->id")}}'>Delete</a>
          @endif
        </td>
       </tr>
    @endforeach
  </tbody>
</table>

<!-- ADD A PAGINATION 
<p>{ urldecode(str_replace("/?","?",$tasks->appends(Request::all())->render())) }</p>


-->
@endsection
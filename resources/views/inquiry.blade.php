<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>Report Form</div>
    <div class='panel-body'>
      <form method="GET" action="{{ route('report')}}">
        <div class='form-group'>
          <label>From</label>
          <input type="date" name="from" required class="form-control"/>
        </div>
        <div class='form-group'>
            <label>To</label>
            <input type="date" name="to" required class="form-control"/>
          </div>
        <div class='panel-footer'>
            <input type='submit' class='btn btn-primary' value='Save changes'/>
          </div>
        </div>
      </form>

   
  </div>
@endsection

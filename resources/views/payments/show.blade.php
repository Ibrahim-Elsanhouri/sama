<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>تفاصيل الدفعة</div>
    <div class='panel-body'>      
        <div class='form-group'>
          <label>المشروع</label>
          <p>{{$payment->project->name }}</p>
        </div>
        <div class='form-group'>
            <label>البنك</label>
            <p>{{$payment->bank->name }}</p>
          </div>
        
          <div class='form-group'>
            <label>المبلغ</label>
            <p>{{$payment->amount }}</p>
          </div>
          <div class='form-group'>
            <label>تاريخ الدفعة</label>
            <p>{{$payment->payment_date }}</p>
          </div>
          <div class='form-group'>
            <label>الفاتورة </label>
            <div class="text-center">
                <p><a href="{{ route('invoice' , $payment->id )}}" target="_blank" class="btn btn-primary">طباعة الفاتورة</a></p>

            </div>
          </div>
        <!-- etc .... -->
        
      </form>
    </div>
  </div>
@endsection
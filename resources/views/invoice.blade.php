<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>الفاتورة الالكترونية</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="{{ asset('assets/css/bootstrap.css')}}" rel="stylesheet" />
	  <!-- CUSTOM STYLE  -->
    <link href="{{ asset('assets/css/custom-style.css')}}" rel="stylesheet" />
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500&display=swap" rel="stylesheet">
</head>

<script type="text/javascript">
    function printDev(){
        var printContents = document.getElementById('print').innerHTML; 
        var originalContents = document.body.innerHTML; 
        document.body.innerHTML = printContents; 
        window.print(); 
        document.body,innerHTML = originalContents; 
        location.reload();
        
    }
    
        </script>


<body dir="rtl">
 <div class="container" >
     

    <div id="print">
      <div class="row pad-top-botm " >
         <div class="col-lg-6 col-md-6 col-sm-6 ">
            <img src="{{ asset('assets/img/logo.jpeg')}}" width="400" height="180" style="padding-bottom:20px;" /> 
         </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            
               <strong>         شركة سما الاهلية للاستشارات المهنية </strong>
              <br />
                  <i>العنوان :</i> جدة -  حي الصفا - شارع الامير محمد بن عبدالعزيز (التحلية سابقا) 
              <br />
منطقة جدة              <br />
المملكة العربية السعودية              
         </div>
     </div>
     <div  class="row text-center contact-info">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <hr />
         
          
             <span>
                <strong>(Tax Invoice)  فاتورة ضريبية </strong>  
            </span>
            <hr />
        </div>
    </div>
     <div  class="row text-center contact-info">
         <div class="col-lg-12 col-md-12 col-sm-12">

     
             <span>
                <strong> (Invoice No) رقم الفاتورة  : </strong>  {{ $payment->id }}  
            </span>
             <span>
                 <strong>(P.O.Box) س . ت : </strong>  4030247934
             </span>
             <span>
                 <strong>الرقم الضريبي (VAT No) : </strong>3107945481000003 
             </span>
              <span>
                 <strong> رقم السجل التجاري  (CR No) : </strong>4031404858   
             </span>
          
            
         </div>
     </div>
     <div  class="row pad-top-botm client-info">
         <div class="col-lg-6 col-md-6 col-sm-6">
         <h4>  <strong>معلومات العميل (Client Information)</strong></h4>
           <strong>  {{ $payment->project->user->name }}</strong>
              <br />
             <b>الجوال (Mobile) :</b>  {{ $payment->project->user->mobile }}           
         </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
               <h4><strong>معلومات الدفع(Payemnt Details)  </strong></h4>
            <b> المبلغ (Amount) : {{ $payment->amount }}   </b>
              <br/>
                 تاريخ الدفعة (Payment Date):    {{ $payment->payment_date}}
           
         </div>
     </div>
     <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> (No) تسلسل</th>
                                    <th> (Amoutn) المبلغ </th>
                                    <th>ضريبة القيمة االمضافة (VAT)</th>
                                    <th>المجموع (Total )</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        {{ round($payment->amount / 1.15  , 2)}}

                                    </td>

                                    <td>{{ round($payment->amount -   $payment->amount / 1.15 , 2)   }}</td>
                                    <td>{{ round($payment->amount , 2)  }}</td>
                                </tr>
                             
                         
                                
                            </tbody>
                        </table>
               </div>
             <hr />
             
             <hr />
              <div class="ttl-amts">
                  <h5> ضريبة القيمة المضافة :          {{ round( $payment->amount -   $payment->amount / 1.15 , 2)  }}
                </h5>
             </div>
         
              <div class="ttl-amts">
                  <h4> <strong>المجموع :{{ round($payment->amount  , 2)}} ريال سعودي </strong> </h4>
             </div>
         </div>
     </div>
          
<div class="col-lg-6 col-md-6 col-sm-6"  >
    <?php 
$data = [
'Company' => 'Sama Engineering and Industrial Consulting' ,
'Total ' => round($payment->amount  , 2 ) , 
'VAT Amount' => round( $payment->amount -   $payment->amount / 1.15 , 2) , 
'Invoice Date' => $payment->payment_date

];
$qr_data = json_encode($data); 

?>
    {!! QrCode::size(200)->generate($qr_data) !!}

</div>

        






           
        </div>
      <div class="row pad-top-botm">
         <div class="col-lg-12 col-md-12 col-sm-12">
             <hr />
             <button class="btn btn-primary" id="print_button"  onclick="printDev()" class="btn btn-primary btn-lg" >Print Invoice</button>
    

             </div>
         </div>
 </div>

</body>

</html>

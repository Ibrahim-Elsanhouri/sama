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
<body dir="rtl">
 <div class="container">
     
      <div class="row pad-top-botm ">
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
                <strong>  فاتورة ضريبية </strong>  
            </span>
            <hr />
        </div>
    </div>
     <div  class="row text-center contact-info">
         <div class="col-lg-12 col-md-12 col-sm-12">
             <hr />
             <span>
                 <strong> س . ت : </strong>  4030247934
             </span>
             <span>
                 <strong>الرقم الضريبي  : </strong>3107945481000003 
             </span>
              <span>
                 <strong>راس المال : </strong>  25000 ريال  
             </span>
             <hr />
         </div>
     </div>
     <div  class="row pad-top-botm client-info">
         <div class="col-lg-6 col-md-6 col-sm-6">
         <h4>  <strong>معلومات العميل </strong></h4>
           <strong>  {{ $payment->project->user->name }}</strong>
  
              <br />
      
             <b>الجوال :</b>  {{ $payment->project->user->mobile }}
              <br />
             <b>البريد الالكتروني :</b> {{ $payment->project->user->email }}
         </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            
               <h4>  <strong>معلومات الدفع  </strong></h4>
            <b> المبلغ  : {{ $payment->amount }}   </b>
              <br />
                 تاريخ الدفعة :    {{ $payment->payment_date}}
              <br />
               <b>الحالة  :  مدفوع </b>
           
         </div>
     </div>
     <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>تسلسل</th>
                                    <th>المبلغ </th>
                                    <th>ضريبة القيمة االمضافة</th>
                                    <th>المجموع </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        {{ $payment->amount / 1.15 }}

                                    </td>

                                    <td>{{  $payment->amount -   $payment->amount / 1.15  }}</td>
                                    <td>{{ $payment->amount }}</td>
                                </tr>
                             
                         
                                
                            </tbody>
                        </table>
               </div>
             <hr />
             
             <hr />
              <div class="ttl-amts">
                  <h5> ضريبة القيمة المضافة :          {{  $payment->amount -   $payment->amount / 1.15  }}
                </h5>
             </div>
             <hr />
              <div class="ttl-amts">
                  <h4> <strong>المجموع :{{ $payment->amount }} ريال سعودي </strong> </h4>
             </div>
         </div>
     </div>
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">
            <strong> نقاط مهمة</strong>
             <ul>
                  <li>
تعتبر هذه فاتورة الكترونية مثبته من سما للاستشارات الهندسية
                 </li>
          <!--       <li>
                     Please read all terms and polices on  www.yourdomaon.com for returns, replacement and other issues.

                 </li> -->
             </ul>
             </div>
         </div>
      <div class="row pad-top-botm">
         <div class="col-lg-12 col-md-12 col-sm-12">
             <hr />
             <a href="#" onclick="print()" class="btn btn-primary btn-lg" >Print Invoice</a>
             &nbsp;&nbsp;&nbsp;
              <a href="#"  onclick="print()" class="btn btn-success btn-lg" >Download In Pdf</a>

             </div>
         </div>
 </div>

</body>
</html>

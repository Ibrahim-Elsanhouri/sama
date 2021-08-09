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
            
               <strong>       سما للاستشارات الهندسية و الصناعية</strong>
              <br />
                  <i>العنوان :</i> جدة - شارع جدة 
              <br />
منطقة جدة              <br />
المملكة العربية السعودية              
         </div>
     </div>
     <div  class="row text-center contact-info">
         <div class="col-lg-12 col-md-12 col-sm-12">
         
         
              <span>
                 <strong>تقرير المبيعات و التحصيل</strong>  
             </span>
             <hr />
         </div>
     </div>
     <div  class="row  client-info">
         <div class="col-lg-12 col-md-12 col-sm-12">
         <h4>  <strong> عدد المشاريع </strong></h4>
           <strong>  {{ $projects->count() }}</strong>
  
              <br />
      
             <b>ضريبة القيمة المضافة :</b>  {{ $projects->sum('price') * 0.15 }}
          
         </div>
         
     </div>
     <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>المشروع</th>
                                    <th>قيمة المشروع </th>
                                    <th>  المبلغ المسدد</th>
                                    <th>صافي الحساب </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                <tr>
                                    <td>{{$project->name}}</td>
                                    <td>
                                        {{$project->price}}

                                    </td>

                                    <td>                
                                                          {{$project->payments->sum('amount') }}    
                                    </td>
                                    <td>                      
                                                     {{ $project->price - $project->payments->sum('amount')  }}
                                    </td>
                                </tr>     
                                @endforeach
                           
                              
                              
                             
                         
                                
                            </tbody>
                        </table>
               </div>
             <hr />
             <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th colspan="4">
                    <div class="text-center">    
                        التحصيل و الدفعات المسددة
                    </div>
                    </th>
                </tr>
                <tr>
                    <th>المشروع</th>
                    <th>قيمة الدفعة </th>
                    <th>العميل</th>
                </tr>
          
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                <tr>
                    <td>{{$payment->project->name}}</td>
                    <td>{{$payment->amount }}</td>

                    <td>
                        {{$payment->user->name}}

                    </td>

                  
                </tr>     
                @endforeach
           
                <tr>
                    <td>التحصيل : {{ $payments->sum('amount') - $payments->sum('amount') * 0.15 }} </td>                    
                    <td> ضريبة القيمة المضافة :{{ $payments->sum('amount') * 0.15 }} </td>
                    <td> الاجمالي :  {{ $payments->sum('amount')}} </td>

                </tr>
              
              
             
         
                
            </tbody>
        </table>
</div>
             <hr />
              <div class="ttl-amts">
               
             </div>
             <hr />
              <div class="ttl-amts">
         <!--         <h4> <strong>صافي الحساب :  user->projects->sum('price') -  $user->payments->sum('amount')  }} ريال سعودي </strong> </h4>
         --> </div>
         </div>
     </div>
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">
            <strong> نقاط مهمة</strong>
             <ul>
                  <li>
كشف حساب الكتروني - سما للاستشارات الهندسية
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
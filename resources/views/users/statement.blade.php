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
                 <strong>كشف حساب عميل</strong>  
             </span>
             <hr />
         </div>
     </div>
     <div  class="row  client-info">
         <div class="col-lg-12 col-md-12 col-sm-12">
         <h4>  <strong>معلومات العميل </strong></h4>
           <strong>  {{ $user->name }}</strong>
  
              <br />
      
             <b>الجوال :</b>  {{ $user->mobile }}
              <br />
             <b>البريد الالكتروني :</b> {{ $user->email }}
             <br />
             <b> عدد المشاريع :</b> {{ $user->projects->count() }}
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
                                @foreach ($user->projects  as $project)
                                <tr>
                                    <td>{{ $project->name}}</td>
                                    <td>
                                        {{ $project->price}}

                                    </td>

                                    <td>                
                                                          {{  $project->payments->sum('amount') }}    
                                    </td>
                                    <td>                      
                                                     {{   $project->price - $project->payments->sum('amount')  }}
                                    </td>
                                </tr> 
                                @endforeach
                              
                             
                         
                                
                            </tbody>
                        </table>
               </div>
             <hr />
             
             <hr />
              <div class="ttl-amts">
               
             </div>
             <hr />
              <div class="ttl-amts">
                  <h4> <strong>صافي الحساب :  {{ $user->projects->sum('price') -  $user->payments->sum('amount')  }} ريال سعودي </strong> </h4>
             </div>
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
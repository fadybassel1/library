
@extends('layouts.app')


@section('content')
<html>
    <head>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Page</title>
        <style type="text/css">

            body {
                display: flex;
                flex-direction: column;
            }
            .container {
                display: flex;
            }
            .sidenav {
                flex-basis: 15%;
                background-color: #333;
                padding-top: 20px;
            }
            .sidenav ul{
                list-style-type: none;
                margin: 0;
                padding: 0;
            }
            .sidenav li{
                margin: 0;
                padding: 5px;
                display: block;
            }

            .sidenav a {
                padding: 14px 16px;
                text-decoration: none;
                font-size: 18px;
                color: white;
                display: block;
            }

            .sidenav li:hover:not(.current) {
                background-color: black;
            }
            .current
            {
                background-color: #d96459;
            }
            .form {
                flex-basis: 40%;
                margin: 1% auto;
                border: solid 1px #333;
            }

            input{
                width: 60%;
                padding: 10px;
                margin: 5px 0 15px 0;
                display: inline-block;
                border: none;
                background: #f1f1f1;
            }
            input[type = submit] , [type = button]{
                width: 40%;
                background: black;
                color: white;
                font-size: 14px;
                border-radius: 20px;
            }
            input[type = radio]{
                width: auto;
                padding: auto;
                margin:auto;
                display: inline;
            }
            input:invalid {
                border: 2px solid red;
            }
            label {
                font-weight: bold;
                width: 100px;
                font-size: 20px;
            }

        </style>
    </head>
    <body bgcolor="#FFFFFF" dir="rtl">
        <div class="container">
            <nav class="sidenav">
                <ul class="sidenav-items">
                    <li id="1" class="current" ><a href="javascript:pageChange(1);">البيانات الشخصية</a></li>
                    <li id="2" class=" "><a href="javascript:pageChange(2);">السكن</a></li>
                    <li id="3" class=" "><a href="javascript:pageChange(3);">الكنيسة / الخدمة</a></li>
                </ul>
            </nav>
            <div class="form">
                <div style="background-color:#333; color:#FFFFFF; padding:3px; text-align: center;"><b>تسجيل</b></div>
                <div style="margin:30px;" align ="right">
                    <form method="post" onkeypress="return handle();">
                        <!-- PAGE 1 البيانات الشخصية + بيانات تملاء بواسطة المكتبة -->
                        <div id="page1" style="display: block">
                            <label>تاريخ الاستمارة :</label><br>
                            <input type="date" name="entrydate" value="<?php echo date("Y-m-d"); ?>"/><br><br>
                            <label>رقم الاستمارة :</label><br>
                            <input type="number" name="formno"id="formno" required /><br><br>
                            <label>CAT :</label><br>
                            <input type="text" name="category"/><br><br>
                            <label>الاسم :</label><br>
                            <input type="text" name="name" id="name" required/><br><br>
                            <label>المحمول :</label><br>
                            <input type="number" name="phone"/><br><br>
                            <label>البريد الالكتروني :</label><br>
                            <input type="email" name="mail" /><br><br>
                            <label>تاريخ الميلاد :</label><br>
                            <input type="date" name="bdate" value="2010-01-01"/><br><br>
                            <input type="button" disabled=false value="التالي" id="next" onclick="javascript:pageChange(2);"/><br>
                        </div>

                        <!-- PAGE 2 السكن -->
                        <div id="page2" style="display: none">
                            <label>رقم العمارة :</label><br>
                            <input type="text" name="buildingno"/><br><br>
                            <label>اسم الشارع :</label><br>
                            <input type="text" name="streetname"/><br><br>
                            <label>المنطقة :</label><br>
                            <input type="text" name="region"/><br><br>
                            <label>المحافظة :</label><br>
                            <input type="text" name="city" /><br><br>
                            <label>الدور :</label><br>
                            <input type="text" name="floorno" /><br><br>
                            <label>الشقة :</label><br>
                            <input type="text" name="appno" /><br><br>
                            <label>البلد :</label><br>
                            <input type="text" name="country"/><br><br>
                            <input type="button" value="التالي"  onclick="javascript:pageChange(3);"/><br>
                        </div>

                        <!-- PAGE 3 الكنيسة + الخدمة -->
                        <div id="page3" style="display: none">
                            <label>اسم الكنيسة :</label><br><br>
                            <input type="text" name="church" class="box"/><br><br>
                            <label>المنطقة :</label><br><br>
                            <input type="text" name="churchlocation" class="box" /><br><br>
                            <label>المحافظة :</label><br><br>
                            <input type="text" name="churchcity" class="box" /><br><br>
                            <label>البلد :</label><br><br>
                            <input type="text" name="churchcountry" class="box"/><br><br>

                            <input value="0" id="s" type="radio" name="type" onclick="javascript:check();" checked>
                            <label>طالب</label>
                            <input value="1" id="g" type="radio" name="type" onclick="javascript:check();">
                            <label>خريج</label>
                            <br><br>

                            <!-- STUDENT -->
                            <div id="student" style="display: block">
                                <label>السنة الدراسية :</label><br><br>
                                <input type="text" name="yearofstudy" class="box" /><br><br>
                                <label>اسم المدرسة / الجامعة :</label><br><br>
                                <input type="text" name="schoolname" class="box"/><br><br>
                            </div>

                            <!-- GRAD -->
                            <div id="grad" style="display: none">
                                <label>المؤهل :</label><br><br>
                                <input type="text" name="degree" class="box" /><br><br>
                                <label>الوظيفة : </label><br><br>
                                <input type="text" name="job" class="box"/><br><br>
                                <label>جهة العمل : </label><br><br>
                                <input type="text" name="company" class="box" /><br><br>
                            </div>


                            <label>الخدمة</label>
                            <input value="0" id="y" type="radio" name="service" onclick="javascript:checkService();" checked>
                            <label>نعم</label>
                            <input value="1" id="n" type="radio" name="service" onclick="javascript:checkService();">
                            <label>لا</label><br><br>

                            <!-- SERVICE -->
                            <div id="service" style="display: block">
                                <label>ما هي الخدمة : </label><br><br>
                                <input type="text" name="servicename" class="box" /><br><br>
                                <label>الكنيسة : </label><br><br>
                                <input type="text" name="servicechurch" class="box"/><br><br>
                            </div>


                            <input type="submit" value="تسجيل" name="submit"/><br>
                        </div>


                    </form>


                    <br><div style="color: #FF0000"><b><?php echo $message ?? ''; ?></b></div>
                </div>
            </div>
        </div>
    </body>
@endsection
    <script>
        document.getElementById("register").className="active";
        const formno = document.getElementById('formno');
        formno.addEventListener('keypress', checkRequired);

        const name = document.getElementById('name');
        name.addEventListener('keypress' , checkRequired);

        function checkRequired ()
        {
            isValid = formno.checkValidity();
            isV = name.checkValidity();
            if ( !isValid || !isV) {
                next.disabled=true;
            } else
            {

                next.disabled = false;
            }
        }
        function handle(e){
            if(e == null)
            {
                e = window.event;
            }
            if (e.keyCode == 13)  {
                if(document.getElementById("page3").style.display == "none")
                {
                    if(document.getElementById("page2").style.display == "none")
                        pageChange(2);
                    else
                        pageChange(3);
                    return false;
                }
                else
                {
                    return true;
                }
            }
        }
        function pageChange(i) {
            if(!next.disabled)
            {
                if (i == 1) {
                    document.getElementById("page1").style.display="block";
                    document.getElementById("page2").style.display="none";
                    document.getElementById("page3").style.display="none";

                    var current = document.getElementsByClassName("current");
                    current[0].className = "";
                    document.getElementById("1").className = "current";


                }
                else if(i == 2)
                {
                    document.getElementById("page1").style.display="none";
                    document.getElementById("page2").style.display="block";
                    document.getElementById("page3").style.display="none";

                    var current = document.getElementsByClassName("current");
                    current[0].className = "";
                    document.getElementById("2").className = "current";
                }
                else{
                    document.getElementById("page1").style.display="none";
                    document.getElementById("page2").style.display="none";
                    document.getElementById("page3").style.display="block";

                    var current = document.getElementsByClassName("current");
                    current[0].className = "";
                    document.getElementById("3").className = "current";
                }
            }
            return false;
        }

        function check() {
            if (document.getElementById('s').checked) {
                document.getElementById("student").style.display="block";
                document.getElementById("grad").style.display="none";
            }
            else
            {
                document.getElementById("student").style.display="none";
                document.getElementById("grad").style.display="block";
            }
            return;
        }

        function checkService() {
            if (document.getElementById('y').checked) {
                document.getElementById("service").style.display="block";
            }
            else
            {
                document.getElementById("service").style.display="none";
            }
            return;
        }
    </script>
</html>

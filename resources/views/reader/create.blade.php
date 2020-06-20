@extends('layouts.app')


@section('content')
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js"></script>
<style>
    .wizard ul>li,
    .tabcontrol ul>li {
        display: block;
        padding: 0;
    }

    .wizard>.steps .current-info,
    .tabcontrol>.steps .current-info {
        position: absolute;
        left: -999em;
    }

    .wizard>.content>.title,
    .tabcontrol>.content>.title {
        position: absolute;
        left: -999em;
    }

    .wizard>.steps>ul>li {
        width: 25%;
    }

    .wizard>.steps>ul>li,
    .wizard>.actions>ul>li {
        float: left;
    }

    .wizard.vertical>.steps>ul>li {
        float: none;
        width: 100%;
    }

    .wizard>.steps a,
    .wizard>.steps a:hover,
    .wizard>.steps a:active {
        display: block;
        width: auto;
        margin: 0 0.5em 0.5em;
        padding: 1em 1em;
        text-decoration: none;
        border-radius: 5px;
    }

    .wizard>.steps .disabled a,
    .wizard>.steps .disabled a:hover,
    .wizard>.steps .disabled a:active {
        background: #eee;
        color: #aaa;
        cursor: default;
    }

    .wizard>.steps .current a,
    .wizard>.steps .current a:hover,
    .wizard>.steps .current a:active {
        background: #fcfcfc;
        color: #111;
        cursor: default;
    }

    .wizard>.steps .done a,
    .wizard>.steps .done a:hover,
    .wizard>.steps .done a:active {
        background: #4CAF50;
        color: #fff;
    }

    .wizard>.steps .error a,
    .wizard>.steps .error a:hover,
    .wizard>.steps .error a:active {
        background: #ff3111;
        color: #fff;
    }

    .wizard>.content {
        background: #eee;
        display: block;
        margin: 0.5em;
        min-height: 60em;
        overflow: hidden;
        position: relative;
        width: auto;
        border-radius: 5px;
    }

    .wizard.vertical>.content {
        display: inline;
        float: left;
        margin: 0 2.5% 0.5em 2.5%;
        width: 65%;
    }

    .wizard>.content>.body {
        float: left;
        position: absolute;
        width: 95%;
        height: 95%;
        padding: 2.5%;
    }

    .wizard>.content>.body ul {
        list-style: disc !important;
    }

    .wizard>.content>.body ul>li {
        display: list-item;
    }

    .wizard>.content>.body>iframe {
        border: 0 none;
        width: 100%;
        height: 100%;
    }

    .wizard>.content>.body input {
        display: block;
        border: 1px solid #ccc;
    }

    .wizard>.content>.body input[type="checkbox"] {
        display: inline-block;
    }

    .wizard>.content>.body input.error {
        background: rgb(251, 227, 228);
        border: 1px solid #fbc2c4;
        color: #8a1f11;
    }

    .wizard>.content>.body label {
        display: inline-block;
        margin-bottom: 0.5em;
    }

    .wizard>.content>.body label.error {
        color: #8a1f11;
        display: inline-block;
        margin-left: 1.5em;
    }

    .wizard>.actions {
        position: relative;
        display: block;
        text-align: right;
        width: 100%;
    }

    .wizard.vertical>.actions {
        display: inline;
        float: right;
        margin: 0 2.5%;
        width: 95%;
    }

    .wizard>.actions>ul {
        display: inline-block;
        text-align: right;
    }

    .wizard>.actions>ul>li {
        margin: 0 0.5em;
    }

    .wizard.vertical>.actions>ul>li {
        margin: 0 0 0 1em;
    }

    .wizard>.actions a,
    .wizard>.actions a:hover,
    .wizard>.actions a:active {
        background: #2184be;
        color: #fff;
        display: block;
        padding: 0.5em 1em;
        text-decoration: none;
        border-radius: 5px;
    }

    .wizard>.actions .disabled a,
    .wizard>.actions .disabled a:hover,
    .wizard>.actions .disabled a:active {
        background: #eee;
        color: #aaa;
    }

    .tabcontrol>.steps {
        position: relative;
        display: block;
        width: 100%;
    }

    .tabcontrol>.steps>ul>li {
        float: left;
        margin: 5px 2px 0 0;
        padding: 1px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .tabcontrol>.steps>ul>li:hover {
        background: #edecec;
        border: 1px solid #bbb;
        padding: 0;
    }

    .tabcontrol>.steps>ul>li.current {
        background: #fff;
        border: 1px solid #bbb;
        border-bottom: 0 none;
        padding: 0 0 1px 0;
        margin-top: 0;
    }

    .tabcontrol>.steps>ul>li>a {
        color: #5f5f5f;
        display: inline-block;
        border: 0 none;
        margin: 0;
        padding: 10px 30px;
        text-decoration: none;
    }

    .tabcontrol>.content {
        position: relative;
        display: inline-block;
        width: 100%;
        height: 35em;
        overflow: hidden;
        border-top: 1px solid #bbb;
        padding-top: 20px;
    }

    #contact {
        background: #F9F9F9;
        padding: 25px;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
</style>
<div class="container">
    <form id="contact" action="#">
        <div>

            <!-- Section 1 البيانات الشخصية + بيانات تملاء بواسطة المكتبة -->
            <h3>البيانات الشخصية</h3>
            <section>
                <p>(*) يجب ان تملاء هذه الحقول</p>
                <label for="entrydate">* تاريخ الاستمارة</label>
                <input id="entrydate" name="entrydate" type="date" class="form-control required"
                    value="{{ date("Y-m-d") }}">
                <label for="formno">* رقم الاستمارة</label>
                <input id="formno" name="formno" type="number" class="form-control required">
                <label for="category">CAT</label>
                <input id="category" name="category" type="text" class="form-control">
                <label for="name">* الاسم</label>
                <input id="name" name="name" type="text" class="form-control required">
                <label for="phone">المحمول</label>
                <input id="phone" name="phone" type="number" class="form-control">
                <label for="mail">البريد الالكتروني</label>
                <input id="mail" name="mail" type="email" class="form-control email">
                <label for="bdate">تاريخ الميلاد</label>
                <input id="bdate" name="bdate" type="date" class="form-control required" value="2010-01-01">
            </section>

            <!-- Section 2 السكن -->
            <h3>السكن</h3>
            <section>
                <p>(*) يجب ان تملاء هذه الحقول</p>
                <label for="buildingno">رقم العمارة</label>
                <input id="buildingno" name="buildingno" type="text" class="form-control">
                <label for="streetname">اسم الشارع</label>
                <input id="streetname" name="streetname" type="text" class="form-control">
                <label for="region">المنطقة</label>
                <input id="region" name="region" type="text" class="form-control">
                <label for="city">المحافظة</label>
                <input id="city" name="city" type="text" class="form-control">
                <label for="floorno">الدور</label>
                <input id="floorno" name="floorno" type="text" class="form-control">
                <label for="appno">الشقة</label>
                <input id="appno" name="appno" type="text" class="form-control">
                <label for="country">البلد</label>
                <input id="country" name="country" type="text" class="form-control">
            </section>

            <!-- PAGE 3 الكنيسة + الخدمة -->
            <h3>الكنيسة / الخدمة</h3>
            <section>
                <div>
                <p>(*) يجب ان تملاء هذه الحقول</p>
                <label for="church">اسم الكنيسة</label>
                <input id="church" name="church" type="text" class="form-control">
                <label for="churchlocation">المنطقة</label>
                <input id="churchlocation" name="churchlocation" type="text" class="form-control">
                <label for="churchcity">المحافظة</label>
                <input id="churchcity" name="churchcity" type="text" class="form-control">
                <label for="churchcountry">البلد</label>
                <input id="churchcountry" name="churchcountry" type="text" class="form-control">
                <br>
                <div class="form-check">
                    <input value="0" id="s" name="type" type="radio" class="form-check-input"
                        onclick="javascript:check();" checked>
                    <label class="form-check-label" for="s">طالب</label>
                </div>
                <div class="form-check">
                    <input value="1" id="g" name="type" type="radio" class="form-check-input"
                        onclick="javascript:check();">
                    <label class="form-check-label" for="g">خريج</label>
                </div>


                <!-- STUDENT -->
                <div id="student" style="display: block">
                    <label>السنة الدراسية</label>
                    <input type="text" name="yearofstudy" class="form-control" />
                    <label>اسم المدرسة / الجامعة</label>
                    <input type="text" name="schoolname" class="form-control" />
                </div>

                <!-- GRAD -->
                <div id="grad" style="display: none">
                    <label>المؤهل</label>
                    <input type="text" name="degree" class="form-control" />
                    <label>الوظيفة</label>
                    <input type="text" name="job" class="form-control" />
                    <label>جهة العمل</label>
                    <input type="text" name="company" class="form-control" />
                </div>

                <br>
                <label>الخدمة</label>
                <div class="form-check">
                    <input value="0" id="y" type="radio" name="service" class="form-check-input"
                        onclick="javascript:checkService();" checked>
                    <label class="form-check-label" for="y">نعم</label>
                </div>
                <div class="form-check">
                    <input value="1" id="n" type="radio" name="service" class="form-check-input"
                        onclick="javascript:checkService();">
                    <label class="form-check-label" for="n">لا</label>
                </div>

                <!-- SERVICE -->
                <div id="service" style="display: block">
                    <label>ما هي الخدمة</label>
                    <input type="text" name="servicename" class="form-control" />
                    <label>الكنيسة</label>
                    <input type="text" name="servicechurch" class="form-control" />
                </div>
                
            </section>
        </div>
    </form>
</div>

<script>
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
    var form = $("#contact");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            email: {
                email: true
            }
        },
        messages: {
            email: {
                required: "aaa"
            }
        }
    });
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        labels: {
            finish: 'تسجيل',
            next: 'التالي',
            previous: 'السابق'
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            alert("Submitted!");
        },
        onInit: function (event, current) {
            $('.actions > ul > li:first-child').attr('style', 'display:none');
        },
    });
</script>
@endsection
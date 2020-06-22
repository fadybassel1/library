
<!DOCTYPE html>
<html lang=""dir="ltr">
<head>
     <style>
     body{
          margin: 0px;
     }
     input{
          float: right;
     }
     a {
          float: right;
          padding: 15px;
          text-align: center;
          text-decoration: none;
          background-color: black;
          color: white;
          font-size: 16px;
          border-radius: 20px;
     }
     </style>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Card</title>
</head>

<body>
     

<input type="hidden" value="{{$reader->name}}" id="name" name="name">
<input type="hidden" value="{{$reader->id}}" id="id" name="id">
<input type="hidden" value="{{$reader->id}}" id="id" name="id">
<input type="hidden" value="{{asset('card.jpeg')}}" id="logo" >
<input type="hidden" value="{{asset("member photos/$photo")}}" id="img" >

    
     <a href="/readers/{{$reader->id}}">go back</a>
     <canvas id="myCanvas" width="325px" height="200px" margin="0px" padding="0px"  outline="0px"  style="border:0px solid #999;" dir="rtl"></canvas>
</body>


</html>


     <script>
     
     var nameTag = "الاسم: ";
     var canvas = document.getElementById('myCanvas');
     var context = canvas.getContext('2d');
     var name=document.getElementById('name').value;
     var id=document.getElementById('id').value;
     var imageObj = new Image();
     var imageObj1 = new Image();
     imageObj1.onload = function(){
          context.drawImage(imageObj, 0, 0 , canvas.width , canvas.height);
          context.font = '20px Calibri';
          context.textAlign = "start";
          context.fillText(nameTag, 300, 95);
          context.fillText(name, 245, 95);
          context.fillText('ID: ', 300, 120);
          context.fillText(id, 245, 120);
          context.font = '30px CCode39';
          context.fillText('*'+ id +'*', 300 , 180 , 280 , 67);
          context.drawImage(imageObj1, 5, 5 , 100 , 100);
     };
     imageObj.src = document.getElementById('logo').value; 
     imageObj1.src =document.getElementById('img').value;
</script>


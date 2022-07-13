<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nery Imports</title>
</head>
<body>
        @if($finally_code)
                <h1>Finally code : {{$finally_code}}</h1>
        @endif
        <script>

                //set name and email in localStorage
                localStorage.setItem('name', '{{$User->name}}');
                localStorage.setItem('email', '{{$User->email}}');

                var finally_code = "{{$finally_code}}";
                var celular = "5503171794589"


                var texto = "Olá, acabo de solicitar uma compra na NeryImports. Esse é meu código [code: "+finally_code+"]";
                texto = window.encodeURIComponent(texto);

               window.open("https://api.whatsapp.com/send?phone=" + celular + "&text=" + texto, "_blank");
        </script>
</body>
</html>
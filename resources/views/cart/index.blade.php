<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.6.0/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <div class="Cart bg-blue-900 flex  flex-row w-full h-full">
        <div class=" bg-white flex items-center flex-col p-6 w-10/12 ">
            <h1 class="text-2xl text-gray-900 flex justify-around"><strong>Meu carrinho</strong>
                <FaOpencart class="ml-9 text-4xl" />
            </h1>
            @if (session('response'))
     
            <div class="alert alert-success">
                    {{ session('response') }}
                </div>
            
            @endif
            @foreach($Products as $item)
            <div class="cardItem flex flex-row justify-between mt-32 border-t-2 w-8/12">
                <div class="flex flex-row  rounded-tl rounded-bl  w-10/12">
                    <img width="100" class="mr-10 rounded-tl rounded-bl" src="{{ url('storage/products') }}/{{ $item['imageSrc'] }}/{{  $item['imageSrc'] }}" alt="{{ $item['imageAlt']}}" />
                    <div class="details flex flex-col items-center justify-around">
                        Produto : {{ $item['name']}},<br />
                        Descrição curta: {{ $item['short_description']}},<br />
                        Quantidade: {{ $item['quantity']}} <br />
                    </div>
                </div>
                <div class="left flex flex-col justify-between p-4">
                    <p class="text-gray-900 text-xl font-bold mb-10">R$ {{ number_format($item['price'],2,",",".") }}</p>
                    <a href="/cart/remove/{{$item['List_id']}}" class="w-40 h-10 flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white hover:text-black bg-red-700 hover:bg-red-200 md:py-4 md:text-lg md:px-10">Remover <span class="ml-4 material-symbols-outlined">
                            delete
                        </span> </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="subtotal flex flex-col items-center w-4/12 bg-white p-4 border">
            <div class="price-total flex flex-col bg-white w-10/12 justify-around  p-10 border-b-2  border-t-2 mb-2">
                <div class="subtotal flex">
                    <div class="text-gray-900 text-xl font-bold mb-10">
                        {{-- Desconto: <br />
                        Frete: <br /><br /> --}}
                        Subtotal:<br />
                    </div>
                    <div class="text-gray-900 text-xl font-bold mb-10">
                        {{-- 0,00%<br />
                        R$ 0,00<br /><br /> --}}
                        R$ {{number_format($Total,2,",",".") }}<br />
                    </div>
                </div>
                <div class="buttons flex flex-col items-center">
                    <form action="/finally" method="POST">
                        <h4 class="font-bold text-black">SEUS DADOS:</h4>
                        <small>Preencha para finalizar sua compra</small>

                        @csrf
                        <div class="label flex flex-col items-start">
                            <label class="font-medium" for="name">Nome:</label>
                            <input required id="name" name="name" type="text" placeholder="Seu nome" class="input input-bordered input-primary w-full max-w-xs bg-white" />
                        </div>
                        <div class="label flex flex-col items-start">
                            <label class="font-medium" for="email">E-mail:</label>
                            <input required id="email" name="email" type="email" placeholder="Seu e-mail" class="input input-bordered input-primary w-full max-w-xs bg-white" />
                        </div>
                        <div class="label flex flex-col items-start">
                            <label class="font-medium" for="phone">Phone:</label>
                            <input required type="tel" id="phone" name="phone"  placeholder="(00) 9 9999-9999" class="input input-bordered input-primary w-full max-w-xs bg-white" />
                        </div>
                        <small>Seu pedido será finalizado via whatsapp. Caso não consiga acessar sua conta não se preocupe, um de nossos consultores entrará em contato.</small>
                        <div class="flex mt-10">
                            <button class="w-40 h-10 flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white hover:text-black bg-green-700 hover:bg-green-200 md:py-4 md:text-lg md:px-10" type="submit">Finalizar  <i class="ml-4 fa fa-whatsapp"></i></button>
                            <a href="#" onclick="cleanStorage()" class="w-61 h-10 ml-2 flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white hover:text-white bg-gray-400 hover:bg-gray-700  md:py-4 md:text-lg md:px-10">Continuar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function cleanStorage() {
            localStorage.clear();
            //set User in Storage
            localStorage.setItem('name', '{{$User->name}'));
            localStorage.setItem('email', '{{$User->email}'));
            localStorage.setItem('phone', '{{$User->phone}'));

            //se o usuario ja informou dados , não obriga-lo a fazer novamente

            //redirect to cart
            window.location.href = "/";

           
        }
    </script>
</body>
</html>

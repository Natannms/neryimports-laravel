<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>
        .menu-mobile{
            display: none;
        }
        .box-image-product{
            width: 100%;
            height: 100%;
        }
        @media screen and (max-width:375px){
            #brand{
                display: none;
            }
            #menu-web{
                display: none;
            }
            #logoMarca{
                margin-left: 20%;
            }
            .title-destaque {
                font-size: 15pt
            }
            .box-image-product{
                width: 12rem;
                height: 12rem;
            }
        }
        @media (min-width:376px) and (max-width:1279px){
            #brand{
                display: none;
            }
            #menu-web{
                display: block;
            }
            #logoMarca{
                margin-left: 38%;
            }
            .title-destaque {
                font-size: 25pt
            }
        }
        @media screen and (min-width:1280px){
            #brand{
                display: none;
            }
            #menu-web{
                display: block;
            }
            #logoMarca{
                margin-left: 38%;
            }
            .title-destaque {
                font-size: 35pt
            }
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d'
                    , }
                }
            }
        }

    </script>
    <title>Nery Imports</title>
</head>
<body>
    <header class="App-header flex justify-between">
        <nav id="menu-web" class='bg-yellow-500 w-screen h-14'>
            <h1 id="brand" class="brand bg-yellow-500 w-2/12 h-14 text-white font-extrabold flex justify-center items-center text-1x1" style="font-family: 'Roboto', sans-serif;">NERY IMPORTS</h1>
            <ul class='flex justify-end pr-10 items-center mt-2'>
                <li class='mr-10'>
                    <a href="#" class='text-white ml-2'>Home</a>
                    <a href="#" class='text-white ml-2'>Produtos</a>
                    <a href="#" class='text-white ml-2'>Promoções</a>
                    <a href="#" class='text-white ml-2'>Contact</a>
                </li>
                <li class="flex">
                    <img src="{{url('storage/images')}}/carrinho-de-compras.png" width="20">
                  {{-- if cartQuantity exist in session --}}
                    @if(session()->has('cartQuantity'))
                        <sub><strong id="">{{session()->get('cartQuantity')}}</strong></sub>
                    @endif
                        
                </li>
            </ul>
        </nav>
    </header>
    <div class="relative bg-black overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-black sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-black transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>

                <div>
                    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
                            <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                                <div class="flex items-center justify-between w-full md:w-auto">
                                    <div class="-mr-2 flex items-center md:hidden">
                                        <button onclick="OpenMainMenu('open')" type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-yellow-500" aria-expanded="false">
                                            <span class="sr-only">Open main menu</span>
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                                @if($categories)
                                    @foreach($categories as $category)
                                        <a href="{{route('category.show', $category->id)}}" class="font-medium text-gray-500 hover:text-gray-900">{{$category->name}}</a>
                                    @endforeach
                                @endif
                            </div>
                        </nav>
                    </div>


                    <div class="absolute z-10 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
                        <div id="menu-mobile" class="menu-mobile rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="px-5 pt-4 flex items-center justify-between">
                                <div>
                                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-yellow-600.svg" alt="" />
                                </div>
                                <div class="-mr-2">
                                    <button onclick="OpenMainMenu('close')" type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-yellow-500">
                                        <span class="sr-only">Close main menu</span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="px-2 pt-2 pb-3 space-y-1">
                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Product</a>

                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Features</a>

                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Marketplace</a>

                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Company</a>
                            </div>
                            <a href="#" class="block w-full px-5 py-3 text-center font-medium text-yellow-600 bg-gray-50 hover:bg-gray-100"> Log in </a>
                        </div>
                    </div>
                </div>

                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28 bg-black">
                    <div class="sm:text-center lg:text-left">
                        <img id="logoMarca" src="{{url("storage/nery")}}/logoMarca.png" alt="" srcset="" width="200" class="mb-20 xl:ml-24">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-100 sm:text-5xl md:text-6xl">
                            <span  class="myTitle block xl:inline">Seu smartphone </span>
                            <span class="mySubTitle text-yellow-600 xl:inline">novo e importado</span>
                        </h1>
                        {{-- <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p> --}}
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 md:py-4 md:text-lg md:px-10"> Promoções </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 md:py-4 md:text-lg md:px-10"> Mais vendidos </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1598327105740-820e04db502e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=627&q=80" alt="" />
        </div>
    </div>


    <div class="flex flex-col items-center max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="title-destaque text-gray-500 font-bold  mb-20 mt-20">Veja os mais vendidos da nery imports</h2>
        <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8  mb-20">
            @if($categories)
                @foreach($categories as $category)
                    <a href="{{route('category.show', $category->id)}}" class="font-medium text-gray-500 hover:text-gray-900">{{$category->name}}</a>
                @endforeach
            @endif
        </div>
        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 ">
            @foreach ($products as $item)
                <div key={product.id} class="group flex flex-col justify-between p-4">
                    <div class="box-image-product bg-indigo-700 aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                        <img src="{{ url('storage/products') }}/{{ $item['imageSrc'] }}/{{  $item['imageSrc'] }}" alt="{{$item['imageAlt']}}" class="w-full h-full object-center object-cover group-hover:opacity-75" />
                    </div>
                    <h3 class="mt-4 font-bold text-xl text-gray-700 mb-10"> {{$item['name']}}</h3>
                    <p class="mt-1 text-lg font-small text-gray-500 mb-10"> {{$item['short_description']}}</p>
                    <ul class="flex">
                        <li class="text-yellow-400 text-2xl">
                            @for($i = 0; $i < $item['rate']; $i++)
                                <span class="material-symbols-outlined">
                                    star
                                </span>
                            @endfor
                        </li>
                    </ul>
                    <p class="mt-1 mb-10 text-xl font-medium text-gray-900">R$ {{ number_format($item['price'],2,",",".")}}</p>
                    <div class="mt-3 sm:mt-0 sm:ml-3">
                    <a href="/products/{{$item['id']}}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white hover:text-black bg-yellow-700 hover:bg-yellow-200 md:py-4 md:text-lg md:px-10">Ver mais</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function OpenMainMenu(param) {
          switch (param) {
            case "open":
                document.getElementById("menu-mobile").style.display = "block";
                break;
            case "close":
                document.getElementById("menu-mobile").style.display = "none";
                break;
          
            default:
                break;
          }
        }
        const totalItems = localStorage.getItem('totalItemsInCart');
        if (totalItems) {
            document.getElementById('totalItemsInCart').innerHTML = totalItems;
        }
    </script>
</body>
</html>

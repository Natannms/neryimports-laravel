<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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
    <div class="">
        <div class="bg-white">           
            <div class="pt-6">
                <nav aria-label="Breadcrumb">
                    <ol role="list" class="max-w-2xl mx-auto px-4 flex items-center space-x-2 sm:px-6 lg:max-w-7xl lg:px-8">
                        <li>
                            <div class="flex items-center">
                                <a href="/" class="mr-2 text-4xl font-medium text-gray-900"> <FaArrowAltCircleLeft /> </a>
                                <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                                </svg>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <a href="#" class="mr-2 text-4xl font-medium text-gray-900"> {{$product["name"]}} </a>
                                <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                                </svg>
                            </div>
                        </li>
                    </ol>
                </nav>

                <div class="mt-6 max-w-2xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
                    <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
                        <img src="{{ url('storage/products') }}/{{ $product->image }}/{{ $product->image }}" alt={{$product['imageAlt']}} class="w-full h-full object-center object-cover" />
                    </div>
                    {{-- <div class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8">
                        <div class="aspect-w-3 aspect-h-2 rounded-lg overflow-hidden">
                            <img src={{$product['imageSrc']}} alt="Model wearing plain black basic tee." class="w-full h-full object-center object-cover" />
                        </div>
                        <div class="aspect-w-3 aspect-h-2 rounded-lg overflow-hidden">
                            <img src={{$product['imageSrc']}} alt="Model wearing plain gray basic tee." class="w-full h-full object-center object-cover" />
                        </div>
                    </div>
                    <div class="aspect-w-4 aspect-h-5 sm:rounded-lg sm:overflow-hidden lg:aspect-w-3 lg:aspect-h-4">
                        <img src={{$product['imageSrc']}} alt="Model wearing plain white basic tee." class="w-full h-full object-center object-cover" />
                    </div> --}}
                </div>

                <div class="max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:pb-24 lg:px-8 lg:grid lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8">
                    <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">{{$product['name']}}</h1>
                    </div>

                    <div class="mt-4 lg:mt-0 lg:row-span-3">    
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl text-gray-900">$ {{$product['price']}}</p>

                        <div class="mt-6">
                            <h3 class="sr-only">Reviews</h3>
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <ul class="flex">
                                        <li class="text-yellow-400 text-2xl">
                                            @for($i = 0; $i < $product['rate']; $i++)
                                                <span class="material-symbols-outlined">
                                                    star
                                                </span>
                                            @endfor
                                        </li>
                                    </ul>
                                </div>
                               
                            </div>
                            
                            <div id="quantityInput">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <span class="text-sm font-medium text-gray-900">Quantity</span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="flex items-center">
                                            <div class="flex-1 px-2">
                                                <input id="selectedQtd" placeholder="1" type="number" class="form-input block w-full leading-5 text-gray-700"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="/addToCart" method="post" id="addToBagForm">
                                @csrf
                                <input type="hidden" name="id" value="{{$product['id']}}">
                                <input type="hidden" id="continueInShop" name="continueInShop" value="true">
                                <input type="hidden" name="quantity"  id="qtd">
                            </form>
                            <a data-toggle="modal" data-target="#toBag" class="flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out md:py-4 md:text-sm md:px-6" onclick="buy()">
                               Adicionar ao carrinho
                            </a>
                        </div>
                    </div>

                    <div class="py-10 lg:pt-6 lg:pb-16 lg:col-start-1 lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                        <div>
                            <h3 class="sr-only">Description</h3>

                            <div class="space-y-6">
                                <p class="text-base text-gray-900">
                                    {{$product['short_description']}}
                                </p>
                            </div>
                        </div>

                        {{-- <div class="mt-10">
                            <h3 class="text-sm font-medium text-gray-900">Highlights</h3>

                            <div class="mt-4">
                                <ul role="list" class="pl-4 list-disc text-sm space-y-2">
                                    <li class="text-gray-400"><span class="text-gray-600"> {{$product['long_description']}}</span></li>
                                </ul>
                            </div>
                        </div> --}}

                        <div class="mt-10">
                            <h2 class="text-sm font-medium text-gray-900">Detalhes</h2>

                            <div class="mt-4 space-y-6">
                                <p class="text-sm text-gray-600">
                                    {{$product['long_description']}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal -->
<div class="modal" id="toBag">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Minhas compras</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div id="" class="modal-body">
            <div id="user-verified" class="options">
                <h1 class="text-bold text-xl mb-10 ">Continuar Comprando ?</h1>
                <a href="#" class="btn bg-gray-400" onclick="continueInShop('continue')">Continuar comprando</a>
                <a id="toMycart" href="#" class="btn bg-yellow-400" onclick="continueInShop('cart')">Ir para o Carrinho</a>
            </div>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn bg-red-500 text-white" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    const addToBagForm = document.getElementById('addToBagForm');
   
    function continueInShop(option) {
        document.getElementById('continueInShop').value = option;
        let selectedQtd = document.getElementById('selectedQtd').value;
        let qtd = document.getElementById('qtd');

        if(selectedQtd == '') {
            qtd.value = 1;
        } else {
            qtd.value = selectedQtd;
        }
        addToBagForm.submit();
    }

</script>
</body>
</html>
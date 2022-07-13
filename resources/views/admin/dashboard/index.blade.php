<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.6.0/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- bootstrap --}}

    <title>Document</title>
</head>

<body>
    {{-- check if session user_id exist --}}
    @if (Session::has('user_id'))
        <div id="dash" class="bg-base-700 flex  bg-screen h-screen p-2">

            {{-- if exist message of success --}}
            <div class="row bg-base-700  w-2/12">
                <div class="saudacao flex flex-col text-white items-center p-4">
                    <h4>Seja bem vindo </h4>
                    <h5 class="font-extrabold">{{ Session::get('name') }}</h5>
                </div>
                <div class="col-md-12">
                    {{-- createa menu of options --}}
                    <ul class="menu bg-base-100">

                        <li><a href="#Products" onclick="view('section-products')">Produtos</a></li>
                        <li class="bordered h-500">
                            <span>Categoria</span>
                            <div id="AddCategoryForm">
                                <form action="{{ route('admin-category-store') }}" method="POST">
                                    @csrf
                                    <div class="form-control">
                                        <div class="input-group">
                                            <input required type="text" placeholder="Nova categoria" name="category"
                                                class="input input-bordered" />
                                            <button type="submit" class="btn btn-square">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-check" width="44"
                                                    height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="listCategory" class="bg-gray-700">
                                <ul class="flex w-full">
                                    @foreach ($categories as $item)
                                        <li class="flex flex-row items-center justify-between w-full">
                                            {{ $item->name }}
                                            <a href="/administerNery/category/delete/{{ $item->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-trash" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="#ff2825" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <line x1="4" y1="7" x2="20" y2="7" />
                                                    <line x1="10" y1="11" x2="10" y2="17" />
                                                    <line x1="14" y1="11" x2="14" y2="17" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="btn primary"><a href="/administerNery/logout" class="">SAIR</a></li>
                    </ul>

                </div>
            </div>
            <div class="row bg-base-300 w-11/12">
                {{-- alert de erro ao inserir novo produto --}}
                
                <div id="menu-actions" class="col-md-12 flex flex-col ">
                    <div class="flex flex-row justify-between">
                        <button class="btn primary" onclick="view('section-addProduct')">Novo produto</button>
                    </div>
                </div>

                <div id="section-products" class="col-md-12 flex flex-col items-center">
                    {{-- create section for products table --}}
                    <div class="overflow-x-auto p-4 w-full">
                        <table class="table w-full">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Imagem</th>
                                    <th>Categoria</th>
                                    <th>Detalhes</th>
                                    <th>Avaliação</th>
                                    <th>Marca</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 2 -->
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td> <img
                                                src="{{ url('storage/products') }}/{{ $product->image }}/{{ $product->image }}"
                                                width="70"></td>
                                        <td>
                                            <a onclick="viewCategory({{ $product->category_id }})"
                                                class="btn btn-primary">Editar</a>
                                        </td>
                                        <td><a href="/products/{{ $product->id }}">Ver</a></td>
                                        <td>
                                            @for ($i = 0; $i < $product->rate; $i++)
                                                <span class="material-symbols-outlined">
                                                    star
                                                </span>
                                            @endfor
                                        </td>
                                        <td>{{ $product->brand }}</td>
                                        <td>
                                            <a href="/administerNery/product/update/{{ $product->id }}"
                                                class="btn btn-primary">Editar</a>
                                            <a href="/administerNery/product/delete/{{ $product->id }}"
                                                class="btn bg-red-700">Deletar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="section-addProduct" class="col-md-12 flex flex-col" style="display: none;">
                    {{-- form for product creation --}}
                    <form action="/administerNery/product/store" method="post" class="p-14"
                        enctype="multipart/form-data">
                        <h3>Novo Produto</h3>
                        @csrf
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Nome</span>
                            </label>
                            <label class="input-group">
                                <input required type="text" name="name" placeholder="product name..."
                                    class="input input-bordered  w-80" />
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Marca</span>
                            </label>
                            <label class="input-group">
                                <input required type="text" name="brand" placeholder="xiaomi, apple, LG..."
                                    class="input input-bordered  w-80" />
                            </label>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Preço</span>
                            </label>
                            <label class="input-group">
                                <input required type="text" name="price" placeholder="1045.50"
                                    class="input input-bordered w-80" />
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Categoria</span>
                            </label>
                            <label class="input-group">
                                <select name="category_id" class="input input-bordered  w-80">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Imagem</span>
                            </label>
                            <label class="input-group">
                                <input required type="file" name="image" placeholder="product image..."
                                    class="input input-bordered  w-80" />
                            </label>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Estrelas</span>
                            </label>
                            <label class="input-group">
                                <select name="rate" class="input input-bordered  w-80">
                                    <option value="1">1 estrela</option>
                                    <option value="2">2 estrelas</option>
                                    <option value="3">3 estrelas</option>
                                    <option value="4">4 estrelas</option>
                                    <option value="5">5 estrelas</option>
                                    <option value="6">6 estrelas</option>
                                    <option value="7">7 estrelas</option>
                                </select>
                            </label>
                        </div>
                        {{-- <div class="form-control">
                            <label class="label">
                                <span class="label-text">Status</span>
                            </label>
                            <label class="input-group">
                                <select name="status" class="input input-bordered  w-80">
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                            </label>
                        </div> --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Descrição curta</span>
                            </label>
                            <label class="input-group">
                                <input required type="text" name="short_description"
                                    placeholder="product description..." class="input input-bordered  w-80" />
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Descrição longa</span>
                            </label>
                            <label class="input-group">
                                <textarea name="long_description" class="textarea textarea-primary" cols=40" placeholder="Bio"></textarea>
                            </label>
                        </div>
                        <div class="form-control">
                            <button type="submit" class="btn btn-primary  w-60 mt-10">Criar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Olá Usuário você precisar realizar login novamente.</h1>
                    <a href="/administerNery/login" class="btn btn-primary">Login</a>
                </div>
            </div>
        </div>
    @endif
    <script>
        let sections = [
            'section-products',
            'section-addProduct',
        ]

        function view(section_id) {
            sections.forEach(element => {
                //get the element
                let el = document.getElementById(element)
                //add style display none to the element
                if (element == section_id) {
                    el.style.display = 'block'
                } else {
                    el.style.display = 'none'
                }
            });
        }
    </script>
</body>

</html>

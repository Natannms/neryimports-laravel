<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.22.0/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>nery imports</title>
</head>

<body>
    <h3 class="text-3xl font-black mt-10 ml-20">Editar Produto</h3>
    <hr class="bg-white mt-10">
    <form
    class="w-screen p-6 shadow-md rounded-lg flex items-center"
    action="/administerNery/product/update/{{ $result['product']->id }}" method="post" class="p-14" enctype="multipart/form-data">
        @csrf
        <div class="column-left ml-10">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nome</span>
                </label>
                <label class="input-group">
                    <input required type="text" value="{{ $result['product']->name }}" name="name" placeholder="product name..."
                        class="input input-bordered  w-80" />
                </label>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Marca</span>
                </label>
                <label class="input-group">
                    <input required type="text"  value="{{ $result['product']->brand }}" name="brand" placeholder="xiaomi, apple, LG..."
                        class="input input-bordered  w-80" />
                </label>
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Preço</span>
                </label>
                <label class="input-group">
                    <input required type="text"  value="{{ $result['product']->price }}" name="price" placeholder="1045.50"
                        class="input input-bordered w-80" />
                </label>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Parcelado em até:</span>
                </label>
                <label class="input-group">
                    <input type="number" name="installments"  value="{{ $result['product']->installments }}" placeholder="1" class="input input-bordered w-80" />
                </label>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Categoria</span>
                </label>
                <label class="input-group">
                    <select name="category_id" class="input input-bordered  w-80">
                        @foreach ($result['categories'] as $item)
                            <option
                            @if ($result['product']->category_name == $item->name)
                                selected
                            @endif
                            value="{{ $item->id }}">{{ $item->name }}
                        </option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <div class="column-middle ml-10">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Imagem</span>
                    <img width="70"  src="{{ url('storage/products') }}/{{ $result['product']->image }}/{{ $result['product']->image }}" alt="">
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
                        {{-- crie um loope para contar até 7 --}}
                        @for ($i = 1; $i <= 7; $i++)
                            <option
                                @if ($result['product']->rate == $i)
                                    selected
                                @endif
                                value="{{ $i }}">{{ $i }} estrela
                            </option>
                        @endfor

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
                    <input required value="{{$result['product']->short_description}}" type="text" name="short_description" placeholder="product description..."
                        class="input input-bordered  w-80" />
                </label>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Descrição longa</span>
                </label>
                <label class="input-group">
                    <textarea name="long_description" class="textarea textarea-primary" cols=40" placeholder="Bio" required>
                        {{$result['product']->long_description}}
                    </textarea>
                </label>
            </div>
            <div class="form-control">
                <button type="submit" class="btn btn-primary  w-60 mt-10">Salvar</button>
            </div>
        </div>
        <div class="column_right ml-10">
            <h1 class="text-3xl text-purple-700">Sua descrição longa atualmente é:</h1>
            <p class="p-6">
                {{$result['product']->long_description}}
            </p>
        </div>
    </form>

</body>

</html>

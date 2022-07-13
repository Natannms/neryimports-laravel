<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <img src='/storage/categories/cart.jpg' alt="Sandwich" style="width:100%">
    <form action="/product/store" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image">
                <label class="custom-file-label" for="image">Choose file</label>
            </div><hr>
            <input class="form-control" type="text" name="name" placeholder="nome do produto"> <br>
             <input class="form-control" type="text" name="short_description" placeholder="Descrição breve"> <br>
            <input class="form-control" type="text" name="long_description" placeholder="Descrição completa"> <br>
            <input class="form-control" type="text" name="price" placeholder="$"> <br>
            <input class="form-control" type="number" name="rate" placeholder="Avaliação inicial"> <br>
            <input class="form-control" type="text" name="promotion" placeholder="Valor de custo real do produto"> <br>
            <input class="form-control" type="number" name="quantity_installments" placeholder="Em quantas aprcelas"> <br>
            <input class="form-control" type="number" name="quantity_stock" placeholder="Quantidade disponivel no estoque"> <br>
         
            <div class="form-group">
            <label for="">Categoria</label>
            <select class="form-control" name="category" id="">
                <option value="1">Celulares</option>
                <option value="2">Acessórios</option>
                <option value="3">Roupas</option>
                <option value="4">Maquiagem</option>
            </select>
            </div>
            <div class="form-group">
                <label for="">Colocar em destaque ?</label>
                <select class="custom-select" name="highlighted" id="">
                    <option value="true" selected>Sim</option>
                    <option value="false">Não</option>
                </select>
            </div> 
            <button type="submit">Salvar</button>
        </form>
</body>
</html>
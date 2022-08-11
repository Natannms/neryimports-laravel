<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsList = json_decode(file_get_contents(public_path() . "/products.json"), true);
        //filter products by id
        $product = null;
        foreach ($productsList as $productItem) {
            if ($productItem['id'] == request()->id) {
                $product = $productItem;
                return view('products.OneProduct', ["product" => $productItem]);
            } else {
                return view('products.OneProduct', ["product" => []]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToBag(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //remove  first '.' from $request->price
        $price = str_replace('.', '', $request->price);
        // replace ',' by '.'
        $price = str_replace(',', '.', $price);
        //convert string to float
        $price = (float)$price;

        //save image in storage/products
        // Define o valor default para a variável que contém o nome da imagem
        $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->image->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->image->storeAs('public/products/'.$nameFile, $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload){
                return redirect()
                ->back()
                ->with('error', 'Falha ao fazer upload')
                ->withInput();
            }else{
                //save product to database
                $product = new Product();
                $product->name = $request->name;
                $product->price =   $price;
                $product->category_id = $request->category_id;
                $product->short_description = $request->short_description;
                $product->long_description = $request->long_description;
                $product->rate = $request->rate;
                $product->imageSrc = $nameFile;
                $product->imageAlt = $nameFile;
                $product->href = $nameFile;
                $product->brand = $request->brand;
                $product->image = $nameFile;
                $product->installments = (int)$request->installments;
                $product->save();

                if (!$product) {
                    return redirect()
                    ->back()
                    ->with('error', 'Falha ao salvar produto')
                    ->withInput();
                } else {
                    return redirect()
                    ->back()
                    ->with('success', 'Produto salvo com sucesso');
                }
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get product by id
        $product = Product::find($id);
        return view('products.OneProduct', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::query()
            ->select('products.*', 'categories.name as category_name')
            ->where('products.id', $id)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->first();
        ;
        $categories = Category::all();

        $result = [
            'product' => $product,
            'categories' => $categories
        ];
        return view('admin.dashboard.products.edit', compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          //remove  first '.' from $request->price
          $price = str_replace('.', '', $request->price);
          // replace ',' by '.'
          $price = str_replace(',', '.', $price);
          //convert string to float
          $price = (float)$price;

          //save image in storage/products
          // Define o valor default para a variável que contém o nome da imagem
          $nameFile = null;

          // Verifica se informou o arquivo e se é válido
          if ($request->hasFile('image') && $request->file('image')->isValid()) {

              // Define um aleatório para o arquivo baseado no timestamps atual
              $name = uniqid(date('HisYmd'));

              // Recupera a extensão do arquivo
              $extension = $request->image->extension();

              // Define finalmente o nome
              $nameFile = "{$name}.{$extension}";

              // Faz o upload:
              $upload = $request->image->storeAs('public/products/'.$nameFile, $nameFile);
              // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

              // Verifica se NÃO deu certo o upload (Redireciona de volta)
              if (!$upload){
                  return redirect()
                  ->back()
                  ->with('error', 'Falha ao fazer upload')
                  ->withInput();
              }else{
                $product = Product::find($id);
                //update product
                $product->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'category_id' => $request->category_id,
                    'short_description' => $request->short_description,
                    'long_description' => $request->long_description,
                    'rate' => $request->rate,
                    'imageSrc' => $nameFile,
                    'imageAlt' => $nameFile,
                    'href' => 'undefined',
                    'brand' => $request->brand,
                    'image' => $nameFile,
                    'installments' => $request->installments
                ]);

                if (!$product) {
                    return redirect()
                    ->back()
                    ->with('error', 'Falha ao salvar produto')
                    ->withInput();
                } else {
                    return redirect()
                    ->back()
                    ->with('success', 'Produto salvo com sucesso');
                }
              }

            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete product
        $product = Product::find($id);
        $product->delete();
        return back();
    }
}

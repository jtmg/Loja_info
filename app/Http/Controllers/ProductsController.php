<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProdutctRequest;
use App\Http\Requests\NewProductRequest;
use App\Models\Product;
use App\Models\tipo_produto;

class ProductsController extends Controller
{
    public function index(){

        $productos = Product::all();
        $tipos = tipo_produto::all();  
        return view("produtos",["products" => $productos, "tipos" => $tipos, "actTipo" => 1]);
    }

    public function show($id){

        $produto = Product::findOrFail($id);
        return view ("detalhes", ["produto" => $produto]);
    }

    public function create(){

        $tipos = tipo_produto::all();
        $user = auth()->user();
        $userProducts  = $user->products;
        if($userProducts->count() == env("MAX_PRODUTCTS")){
            return redirect("/home")->with("mssg", "Não pode crirar mais produtos");
        }
        return view("createProduct", ['tipos' => $tipos]);
    }

    public function store(NewProductRequest $request){

        $name = request("name");
        $desc =  request("desc");
        $price = request("price");
        $tipo = request("tipoProduto");

        $url = "";
        if ($request->has("url")) {
            $image = $request->file("url");
            $iname = "prod"."_".time();
            $folder = "/img/produtos/";
            $fileName = $iname .".".$image->getClientOriginalExtension();
            $filePath = $folder . $fileName;
            $image->storeAs($folder,$fileName, 'public');
            $url = "/storage/".$filePath;
        }

        $produto = new Product();
        $produto ->nome = $name;
        $produto->desc = $desc;
        $produto->url=$url;
        $produto->preco = $price;
        $produto->tipo_produto_id = $tipo;
        $produto->created_by = auth()->user()->id;


        $produto->save();
        
        return redirect("/produtos/create")->with("mssg","PRoduto criado");
    }

    public function destroy($id){
        $produto = Product::findOrFail($id);
        $produto->delete();

        return redirect("/produtos");
    }

    public function produtosPorTipo($id){
        $tipos = tipo_produto::all();
        $tipo = tipo_produto::findOrFail($id);
        $prodtos = $tipo->products;

        return view('produtos',["products"=>$prodtos,"tipos" => $tipos, "actTipo" => $id] );
    }

    public function edit($id){
        $tipos= tipo_produto::all();
        $produto = Product::findOrFail($id);
        return view("createProduct",["produto" => $produto, "tipos" => $tipos]);
    }
    
    public function update($id, EditProdutctRequest $request){

        $name = request("name");
        $desc =  request("desc");
        $price = request("price");
        $tipo = request("tipoProduto");

        $changed = request("changed");
        $produto = Product::findOrfail($id);
        if($changed == 'true'){

           $url = "";
        if ($request->has("url")) {
            $image = $request->file("url");
            $iname = "prod"."_".time();
            $folder = "/img/produtos/";
            $fileName = $iname .".".$image->getClientOriginalExtension();
            $filePath = $folder . $fileName;
            $image->storeAs($folder,$fileName, 'public');
            $url = "/storage/".$filePath;
        }
            $produto->url = $url;
        }
        $produto ->nome = $name;
        $produto->desc = $desc;
        $produto->url=$url;
        $produto->preco = $price;
        $produto->tipo_produto_id = $tipo;
        $produto->save();

        return redirect("/produtos/$id")->with("mssg","Produto criado");
        
    }
}

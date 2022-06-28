<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;

use Cart;

class PanierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = Cart::getContent();
        $total = Cart::getTotal();
        return view('paniers.index', compact('content', 'total'));
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
     * @param  \App\Models\Product  $product
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required'
        ]);
        
        $product = DB::select("SELECT products.id as product_id, products.title as product_title, products.slug as product_slug, products.overview as product_overview, 
        products.price as product_price, products.quantity as product_quantity, products.published as product_published,
        files.file_path as files_file_path
        FROM products
        LEFT JOIN files ON files.product_id = products.id
        WHERE products.id = $request->id
        GROUP BY products.id")[0];

        $product = array(
            'id' => $product->product_id,
            'name' => $product->product_title,
            'price' => $product->product_price,
            'quantity' => $request->get('quantity'),
            'attributes' => array(
                'image' => $product->files_file_path
            )
        );
        /*var_dump($product);
        die();*/
        Cart::add($product);
        
        return redirect()->back()->with('cart', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        Cart::update($id, [
            'quantity' => ['relative' => false, 'value' => $request->quantity],
        ]);
        return redirect(route('panier.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect(route('panier.index'));
    }
}

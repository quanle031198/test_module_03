<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('products.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $product = new Product();
            $product->name = $request->input('name');

            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $path = $img->store('images', 'public');
                $product->img = $path;
            }  
            $product->price = $request->input('price');           
            $product->type_id = $request->input('type_id');            
            $product->save();
        
            Session::flash('success', 'Add success!');
            return redirect()->route('product.list');

        } catch (Exception $e) {

            Session::flash('error', 'Add fail!');
            return redirect()->route('product.list');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $types = Type::all();
        
        return view('products.edit', compact('product','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $product->name = $request->input('name');

            if ($request->hasFile('img')) {
                $currentImg = $product->img;
                if ($currentImg) {
                    Storage::delete('/public/' . $currentImg);
                }

                $img = $request->file('img');
                $path = $img->store('images', 'public');
                $product->img = $path;
            }

            $product->price = $request->input('price');           
            $product->type_id = $request->input('type_id');            
            $product->save();
        
            Session::flash('success', 'Update success!');
            return redirect()->route('product.list');

        } catch (Exception $e) {

            Session::flash('error', 'update fail!');
            return redirect()->route('product.list');
        }
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        return view('products.delete',compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $product = Product::findOrFail($id);

            $img = $product->img;
    
            if($img)
            {
                Storage::delete('/public/'. $img);
            }
    
            $product->delete();
    
            //dung session de dua ra thong bao
            Session::flash('success', 'Delete success !');
            //xoa xong quay ve trang danh sach task
            return redirect()->route('product.list');
        }
        catch(Exception $e)
        {
            Session::flash('error', 'Delete faile !');
            //xoa xong quay ve trang danh sach task
            return redirect()->route('product.list');
        }
    }
}

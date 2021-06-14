<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database;
use App\Product;
use App\Category;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(request()->category){
          $products = Product::with('categories')->whereHas('categories',function($query){
            $query->where('slug',request()->category);
          });
          $categories = Category::all();
          $categoryName = optional($categories->where('slug',request()->category)->first())->name;
       } else {

       $products=Product::where('featured',true);
       $categories = Category::all();
       $categoryName = "Featured Item's";
   }

       if(request()->sort == 'low_high') {
           $products = $products->orderBy('price')->paginate(5);
       } else if (request()->sort == 'high_low'){
            $products = $products->orderBy('price','desc')->paginate(5);
       } else {
        $products = $products->paginate(5);
       }

        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName
        ]);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product= Product::where('slug',$slug)->firstOrFail();
        $mightAlsoLike= Product::where('slug','!=',$slug)->mightAlsoLike()->get();

        return view('product')->with([
            'product' => $product,
            'mightAlsoLike' => $mightAlsoLike,
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

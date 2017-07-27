<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Selling';


        $this->data['products'] = Product::select('products.id', 'products.cat_id', 'products.name', 'products.image', 'products.price', 'products.status')
            ->where('status', '=', config('constant.active'))
            ->get();

        $this->data['productLists'] = Product::select('id', 'cat_id', 'name', 'price', 'status')
            ->get();

        $this->data['categories'] = Category::select('id', 'name', 'image', 'status')
            ->where('status', '=', config('constant.active'))
            ->get();

        $this->data['user'] = Auth::user()->name;

        return view('vendor.backpack.base.dashboard', $this->data);
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
    public function getProducts($cat_id)
    {
        $products = Product::select('id', 'cat_id', 'name', 'price', 'image', 'status')
            ->where([['cat_id', '=', $cat_id], ['status', '=', config('constant.active')]])->get();

        return response()->json($products, 201);
    }

    /**
     * getAll product
     */
    public function getAllProduct(){

        $products = Product::where('status', '=', config('constant.active'))->get();
        return response()->json($products, 200);
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

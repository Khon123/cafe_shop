<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\FieldConstant;
use App\Helpers\ImageUploadToLocalPath;
use App\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Product';
        $select = ['products.id', 'products.cat_id', 'products.name', 'products.price', 'products.status'];
        $this->data['products'] = Product::select($select)->orderBy('id', 'desc')->paginate(12);

        $this->data['categories'] = Category::select('id', 'name')->orderBy('id', 'desc')->get();

        return view('vendor.backpack.base.product', $this->data);
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
        $product = new Product();

        $product->cat_id = $request->input(FieldConstant::CAT_ID);
        $product->name   = $request->input(FieldConstant::NAME);
        $product->price = $request->input(FieldConstant::PRICE);

        if($request->hasFile('image')){

            $image = $request->file('image');
            $path  = public_path('/img/product');

            $fileName = ImageUploadToLocalPath::storeImage($image, $path);

            $product->image = $fileName;
        }

        $product->save();

        return response()->json(['product' => $product], 200);

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
        $product = Product::find($id);
        return response()->json($product);
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
        $product = Product::find($id);

        $product->cat_id = $request->input(FieldConstant::CAT_ID);
        $product->name   = $request->input(FieldConstant::NAME);
        $product->price  = $request->input(FieldConstant::PRICE);

        if($request->file('image')!= null){

            $image       = $request->file('image');
            $path        = public_path('/img/product');
            $product->image = $this->storeImage($image, $path);
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
        //
    }
}

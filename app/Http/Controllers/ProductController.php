<?php

namespace App\Http\Controllers;

use App\Category;
use app\Helpers\FieldConstant;
use App\Product;
use Illuminate\Http\Request;

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

//        $image     = $request->file('image');
//        $path      = public_path('/img/product');
//        $imageName = time().'.'. $image.getClientOriginalExtension();
//        Image::make($image->getRealPath())->resize(300,300, function ($constrain){
//            $constrain->aspectRatio();
//        })->save($path.'/'.$imageName);

        $product->cat_id = $request->input(FieldConstant::CAT_ID);
        $product->name   = $request->input(FieldConstant::NAME);
        $product->price = $request->input(FieldConstant::PRICE);

        if($request->file('image')!= null){

            $image     = $request->file('image');
            $path      = public_path('/img/product');

            $product->image = $this->storeImage($image, $path);
        }

        $product->save();

        return response()->json(['product' => $product], 200);

    }

    private function storeImage($image, $path){
        $image     = $image;
        $imageName = time().'.'. $image.getClientOriginalExtension();
        $path      = $path;
        Image::make($image->getRealPath())->resize(300,300, function ($constrain){
            $constrain->aspectRatio();
        })->save($path.'/'.$imageName);

        return $imageName;
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

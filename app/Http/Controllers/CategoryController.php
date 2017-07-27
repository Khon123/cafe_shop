<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\FieldConstant;
use App\Helpers\ImageUploadToLocalPath;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
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
        $this->data['title'] = 'Home';
        $this->data['categories'] = Category::select('id', 'name', 'status')->orderBy('id', 'desc')->paginate(12);

        return view('vendor.backpack.base.category', $this->data );
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
        $category = new Category();

        $category->name     = $request->input(FieldConstant::NAME_CATEGORY);
        if($request->hasFile('image')){

            $image = $request->file('image');
            $path  = public_path('/img/category');

            $fileName = ImageUploadToLocalPath::storeImage($image, $path);

            $category->image = $fileName;
        }
        $category->status   = $request->input(FieldConstant::STATUS_CATEGORY);
        $category->save();

        return response()-> json( $category, 201 );

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
        $category = Category::find($id);
        return response()->json($category, 201);
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
        $category = Category::find($id);

        $category->name     = $request->input(FieldConstant::NAME_CATEGORY);
        if($request->hasFile('image')){

            $image = $request->file('image');
            $path  = public_path('/img/category');

            $fileName = ImageUploadToLocalPath::storeImage($image, $path);

            $category->image = $fileName;
        }
        $category->status   = $request->input(FieldConstant::STATUS_CATEGORY);
        $category->save();

        return response()->json($category, 200);
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

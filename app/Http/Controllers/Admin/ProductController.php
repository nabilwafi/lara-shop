<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->statuses = Product::statuses();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name', 'asc')->paginate(5);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $product = null;
        $categoryIDs = [];
        $productID = 0;
        $statuses = $this->statuses;

        return view('admin.products.form', compact('categories', 'product', 'categoryIDs', 'statuses', 'productID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);
        $params['user_id'] = Auth::user()->id;

        $save = false;
        $save = DB::transaction(function () use ($params) {
            $product = Product::create($params);
            $product->categories()->sync($params['category_ids']);

            return true;
        });

        if($save) {
            Session::flash('success', 'Product has been saved');
        }else {
            Session::flash('error', 'Product could not be saved');
        }

        return redirect()->route('admin.products');
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
        if(empty($id)) {
            return redirect()->route('admin.products.create');
        }

        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name', 'asc')->get();

        $categoryIDs = $product->categories->pluck('id')->toArray();
        $productID = $product->id;

        $statuses = $this->statuses;
        
        return view('admin.products.form', compact('product', 'categories', 'categoryIDs', 'statuses', 'productID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);

        $product = Product::findOrFail($id);

        $save = faLse;
        $save = DB::transaction(function () use ($product, $params) {
            $product->update($params);
            $product->categories()->sync($params['category_ids']);

            return true;
        });

        if($save) {
            Session::flash('success', 'Product has been Updated');
        }else {
            Session::flash('error', 'Product could not be Updated');
        }

        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if($product->delete()) {
            Session::flash('success', 'Product has been deleted');
        }

        return redirect()->back();
    }

    public function images($id)
    {
        if(empty($id)) {
            return redirect()->route('admin.products.create');
        }

        $product = Product::findOrFail($id);
        $paginateImages = ProductImage::where('product_id', $id)->paginate(5);
        $productID = $product->id;
        $productImage = $product->productImages;

        return view('admin.products.images', compact('productID', 'productImage', 'paginateImages' ));
    }

    public function add_image($id) {

        if(empty($id)) {
            return redirect()->route('admin.products');
        }

        $product = Product::findOrFail($id);
        $productID = $product->id;
        // dd($productID);
        return view('admin.products.image_form', compact('productID', 'product'));
    }

    public function upload_image(ProductImageRequest $request, $id) {
        
        $product = Product::findOrFail($id);

        if($request->has('image')) {
            $image = $request->file('image');
            $name = $product->slug.'_'.time();
            $fileName = $name.'.'.$image->getClientOriginalExtension();
        
            $folder = '/upload/images';
            $filePath = $image->storeAs($folder, $fileName, 'public');

            $params = [
                'product_id' => $product->id,
                'path' => $filePath,
            ];

            if(ProductImage::create($params)) {
                Session::flash('success', 'Image has been upload');
            }else {
                Session::flash('error', 'Image could not be upload');
            }

            return redirect()->route('admin.products.images', $product->id);
        }

    }

    public function remove_image($id) {
        
        $image = ProductImage::findOrFail($id);
        
        if($image->delete()) {

            Storage::disk('public')->delete($image->path);
            
            Session::flash('success', 'Image has been deleted');
        }

        return redirect()->back();
    }
}

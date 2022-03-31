<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::whereHas('images')->get();

        return View::make('dashboard.products.view')->with(compact('products'));
    }

    public function create()
    {
        return View::make('dashboard.products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $sort_order = Product::all()->count() + 1;

        $product = Product::create([
            'name' => $request->name,
            'product_code' => $request->product_code,
            'slug' => Str::slug($request->name),
            'tagline'=> $request->tagline,
            'description' => $request->description,
            'price' => $request->price,
            'sort_order' => $sort_order,
            'enabled' => 1,
        ]);

        foreach ($request->file('photos') as $imagefile) {
            $image = new ProductImage;

            $input['upload'] = time().'.'.$imagefile->extension();

            $basePath = base_path();

            $basePath = str_replace("app_base", "", $basePath);

            $destinationPath = $basePath.'htdocs/img/products';

            $imgFile = Image::make($imagefile->getRealPath());

            $imgFile->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['upload']);

            $image->src = '/img/products/'.$input['upload'];
            $image->product_id = $product->id;
            $image->save();
            sleep(1);
        }

        Session::flash('message', 'Successfully created product!');
        return Redirect::to('dashboard/products');
    }

    public function edit(Product $product)
    {
        return View::make('dashboard.products.edit')->with(compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'product_code' => $request->product_code,
            'slug' => Str::slug($request->name),
            'tagline'=> $request->tagline,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        if($request->file('photos')){

            foreach ($product->images as $image){
                $path = public_path("/").$image->src;

                if(File::exists($path)){
                    File::delete($path);
                }

                $image->delete();
            }

            foreach ($request->file('photos') as $imagefile) {
                $image = new ProductImage;

                $input['upload'] = time().'.'.$imagefile->extension();

                $basePath = base_path();

                $basePath = str_replace("app_base", "", $basePath);

                $destinationPath = $basePath.'htdocs/img/products';

                $imgFile = Image::make($imagefile->getRealPath());

                $imgFile->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['upload']);

                $image->src = '/img/products/'.$input['upload'];
                $image->product_id = $product->id;
                $image->save();
                sleep(1);
            }
        }


        Session::flash('message', 'Successfully updated product!');
        return Redirect::to('dashboard/products');
    }

    public function destroy(Product $product)
    {
        $product->images
            ->each(function (ProductImage $productImage) {

                $basePath = base_path();

                $basePath = str_replace("app_base", "", $basePath);

                $destinationPath = $basePath.$productImage->src;

                if(File::exists($destinationPath)){
                    File::delete($destinationPath);
                }
                $productImage->delete();
            });

        $product->delete();

        Session::flash('message', 'Successfully deleted product!');
        return Redirect::to('dashboard/products');
    }

    public function sort(Request $request)
    {

        $products = Product::all();

        foreach ($products as $product) {
            foreach ($request->order as $order) {
                if ($order['id'] == $product->id) {
                    $product->update(['sort_order' => $order['position']]);
                }
            }
        }

        return response('Product Order Updated Successfully.', 200);
    }

    public function enable(Product $product){
        $product->update([
            'enabled' => 1
        ]);

        Session::flash('message', 'Successfully enabled product!');
        return Redirect::to('dashboard/products');
    }

    public function disable(Product $product){
        $product->update([
            'enabled' => 0
        ]);

        Session::flash('message', 'Successfully disabled product!');
        return Redirect::to('dashboard/products');
    }

    public function show(Product $product)
    {
        return view('product')->with(compact('product'));
    }
}

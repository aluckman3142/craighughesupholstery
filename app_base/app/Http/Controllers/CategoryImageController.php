<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryImage\StoreCategoryImageRequest;
use App\Http\Requests\CategoryImage\UpdateCategoryImageRequest;
use App\Models\Category;
use App\Models\CategoryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryImageController extends Controller
{
    public function index()
    {
        $categoryImages = CategoryImage::orderBy('category_id')->orderBy('sort_order')->with('category')->get();

        return View::make('dashboard.category-images.view')
        ->with(compact('categoryImages'));
    }

    public function create()
    {
        $categories = Category::all();

        return View::make('dashboard.category-images.create')->with(compact('categories'));
    }

    public function store(StoreCategoryImageRequest $request)
    {
        $sort_order = CategoryImage::where('category_id', $request->category)->count();

        CategoryImage::create([
            'category_id' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'thumb' => '/img/category-images/thumbs/'.$request->image_name,
            'src' => '/img/category-images/large/'.$request->image_name,
            'sort_order' => $sort_order,
            'enabled' => 1,
        ]);

        Session::flash('message', 'Successfully created category!');
        return Redirect::to('dashboard/category-images');
    }

    public function show($id)
    {
        //
    }

    public function edit(CategoryImage $categoryImage)
    {
        $categories = Category::all();

        return View::make('dashboard.category-images.edit')->with(compact('categoryImage','categories'));
    }

    public function update(UpdateCategoryImageRequest $request, CategoryImage $categoryImage)
    {
        if ($request->image_name != null){
            $thumb_name = '/img/category-images/thumbs/'.$request->image_name;
            $image_name = '/img/category-images/large/'.$request->image_name;
        } else {
            $thumb_name = $categoryImage->thumb;
            $image_name = $categoryImage->src;
        }

        $categoryImage->update([
            'category_id' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'thumb' => $thumb_name,
            'src' => $image_name,
            'enabled' => 1,
        ]);

        Session::flash('message', 'Successfully updated category image!');
        return Redirect::to('dashboard/category-images');
    }

    public function destroy(CategoryImage $categoryImage)
    {
        $sortCategoryImages = CategoryImage::where('sort_order', '>', $categoryImage->sort_order)->where('category_id','=',$categoryImage->category_id)->get();

        foreach ($sortCategoryImages as $sortCategoryImage){
            $sort_order = $sortCategoryImage->sort_order - 1;
            $sortCategoryImage->update([
                'sort_order' => $sort_order
            ]);
        }

        $path = public_path("/").$categoryImage->src;

        if(File::exists($path)){
            File::delete($path);
        }

        $thumb = public_path("/").$categoryImage->thumb;

        if(File::exists($thumb)){
            File::delete($thumb);
        }

        $categoryImage->delete();

        Session::flash('message', 'Successfully deleted category image!');
        return Redirect::to('dashboard/category-images');

    }

    public function enable(CategoryImage $categoryImage){
        $categoryImage->update([
            'enabled' => 1
        ]);

        Session::flash('message', 'Successfully enabled category image!');
        return Redirect::to('dashboard/category-images');
    }

    public function disable(CategoryImage $categoryImage){
        $categoryImage->update([
            'enabled' => 0
        ]);

        Session::flash('message', 'Successfully disabled category image!');
        return Redirect::to('dashboard/category-images');
    }

    public function crop(Request $request){
        $data = $request->image;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);

        $image_name = time() . '.png';

        $basePath = base_path();

        $basePath = str_replace("app_base", "", $basePath);

        $destinationPath = $basePath.'htdocs/img/category-images/thumbs/' . $image_name;

        file_put_contents($destinationPath, $data);

        $data2 = $request->original;

        list($type, $data2) = explode(';', $data2);
        list(, $data2)      = explode(',', $data2);

        $data2 = base64_decode($data2);

        $image_name2 = time() . '.png';

        $destinationPath2 = $basePath.'htdocs/img/category-images/large/' . $image_name2;

        file_put_contents($destinationPath2, $data2);

        return response()->json(['status' => 1, 'message' => "Image uploaded successfully", 'name' => $image_name]);
    }
}

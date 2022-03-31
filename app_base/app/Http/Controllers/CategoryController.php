<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\BeforeAfter;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('sort_order')->get();

        return View::make('dashboard.categories.view')
        ->with(compact('categories'));
    }

    public function create()
    {
        return View::make('dashboard.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $sort_order = Category::all()->count() + 1;

        Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_desc'=> $request->short_desc,
            'long_desc' => $request->long_desc,
            'button_text' => $request->button_text,
            'button_path' => $request->button_path,
            'image_path' => '/img/sections/'.$request->image_name,
            'sort_order' => $sort_order,
            'enabled' => 1,
        ]);

        Session::flash('message', 'Successfully created category!');
        return Redirect::to('dashboard/categories');
    }

    public function show(Category $category)
    {
        if ($category->slug == 'before-after') {
            $items = BeforeAfter::where('enabled', 1)->orderBy('sort_order')->get();
        } else {
            $items = $category->images()->where('enabled', 1)->get();
        }

        return View::make('categories.show')->with(compact('category', 'items'));
    }

    public function edit(Category $category)
    {
        return View::make('dashboard.categories.edit')->with(compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($request->image_name != null){
            $image_name = '/img/sections/'.$request->image_name;
        } else {
            $image_name = $category->image_path;
        }

        $category->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_desc'=> $request->short_desc,
            'long_desc' => $request->long_desc,
            'button_text' => $request->button_text,
            'button_path' => $request->button_path,
            'image_path' => $image_name
        ]);

        Session::flash('message', 'Successfully updated category!');
        return Redirect::to('dashboard/categories');
    }

    public function destroy(Category $category)
    {
        if ($category->inUse() === true){
            return Redirect::to('dashboard/categories')->withErrors(['Category cannot be deleted as it has images assigned!']);
        }

        $sortCategories = Category::where('sort_order', '>', $category->sort_order)->get();

        foreach ($sortCategories as $sortCategory){
            $sort_order = $sortCategory->sort_order - 1;
            $sortCategory->update([
                'sort_order' => $sort_order
            ]);
        }

        $path = public_path("/").$category->image_path;

        if(File::exists($path)){
            File::delete($path);
        }

        $category->delete();
        Session::flash('message', 'Successfully deleted category!');
        return Redirect::to('dashboard/categories');

    }

    public function sort(Request $request)
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            foreach ($request->order as $order) {
                if ($order['id'] == $category->id) {
                    $category->update(['sort_order' => $order['position']]);
                }
            }
        }

        return response('Category Order Updated Successfully.', 200);
    }

    public function enable(Category $category){
        $category->update([
            'enabled' => 1
        ]);

        Session::flash('message', 'Successfully enabled category!');
        return Redirect::to('dashboard/categories');
    }

    public function disable(Category $category){
        $category->update([
            'enabled' => 0
        ]);

        Session::flash('message', 'Successfully disabled category!');
        return Redirect::to('dashboard/categories');
    }

    public function crop(Request $request){
        $data = $request->image;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);

        $image_name = time() . '.png';

        $basePath = base_path();

        $basePath = str_replace("app_base", "", $basePath);

        $destinationPath = $basePath.'htdocs/img/sections/' . $image_name;

        file_put_contents($destinationPath, $data);

        return response()->json(['status' => 1, 'message' => "Image uploaded successfully", 'name' => $image_name]);
    }
}

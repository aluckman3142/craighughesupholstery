<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeforeAfter\StoreBeforeAfterRequest;
use App\Http\Requests\BeforeAfter\UpdateBeforeAfterRequest;
use App\Models\BeforeAfter;
use App\Models\Category;
use App\Models\CategoryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BeforeAfterController extends Controller
{

    public function index()
    {
        $beforeAfters = BeforeAfter::orderBy('sort_order')->get();

        return View::make('dashboard.before-after.view')
        ->with(compact('beforeAfters'));
    }

    public function create()
    {
        return View::make('dashboard.before-after.create');
    }

    public function store(StoreBeforeAfterRequest $request)
    {
        $sort_order = BeforeAfter::all()->count() + 1;

        BeforeAfter::create([
            'title' => $request->title,
            'description' => $request->description,
            'before_src' => '/img/before-after/'.$request->before_image_name,
            'after_src' => '/img/before-after/'.$request->after_image_name,
            'sort_order' => $sort_order,
            'enabled' => 1,
        ]);

        Session::flash('message', 'Successfully added before and after image!');
        return Redirect::to('dashboard/before-after');
    }

    public function show($id)
    {
        //
    }

    public function edit(BeforeAfter $beforeAfter)
    {
        return View::make('dashboard.before-after.edit')->with(compact('beforeAfter'));
    }

    public function update(UpdateBeforeAfterRequest $request, BeforeAfter $beforeAfter)
    {
        if ($request->before_image_name != null){
            $before_image_name = '/img/before-after/'.$request->before_image_name;
        } else {
            $before_image_name = $beforeAfter->before_src;
        }

        if ($request->after_image_name != null){
            $after_image_name = '/img/before-after/'.$request->after_image_name;
        } else {
            $after_image_name = $beforeAfter->after_src;
        }

        $beforeAfter->update([
            'title' => $request->title,
            'description' => $request->description,
            'before_src' => $before_image_name,
            'after_src' => $after_image_name,
            'enabled' => 1,
        ]);

        Session::flash('message', 'Successfully updated before & after image!');
        return Redirect::to('dashboard/before-after');
    }

    public function destroy(BeforeAfter $beforeAfter)
    {
        $sortBeforeAfters = BeforeAfter::where('sort_order', '>', $beforeAfter->sort_order)->get();

        foreach ($sortBeforeAfters as $sortBeforeAfter){
            $sort_order = $sortBeforeAfter->sort_order - 1;
            $sortBeforeAfter->update([
                'sort_order' => $sort_order
            ]);
        }

        $basePath = base_path();

        $basePath = str_replace("/app_base", "", $basePath);

        $beforePath = $basePath.$beforeAfter->before_src;

        if(File::exists($beforePath)){
            File::delete($beforePath);
        }

        $afterPath = $basePath.$beforeAfter->after_src;

        if(File::exists($afterPath)){
            File::delete($afterPath);
        }

        $beforeAfter->delete();

        Session::flash('message', 'Successfully deleted before & after image!');
        return Redirect::to('dashboard/before-after');
    }

    public function sort(Request $request)
    {
        $beforeAfters = BeforeAfter::all();

        foreach ($beforeAfters as $beforeAfter) {
            foreach ($request->order as $order) {
                if ($order['id'] == $beforeAfter->id) {
                    $beforeAfter->update(['sort_order' => $order['position']]);
                }
            }
        }

        return response('Before & After Image Order Updated Successfully.', 200);
    }

    public function enable(BeforeAfter $beforeAfter){
        $beforeAfter->update([
            'enabled' => 1
        ]);

        Session::flash('message', 'Successfully enabled before & after image!');
        return Redirect::to('dashboard/before-after');
    }

    public function disable(BeforeAfter $beforeAfter){
        $beforeAfter->update([
            'enabled' => 0
        ]);

        Session::flash('message', 'Successfully disabled before & after image!');
        return Redirect::to('dashboard/before-after');
    }

    public function beforeCrop(Request $request){
        $data = $request->image;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $image_name = time() . '.png';

        $basePath = base_path();

        $basePath = str_replace("app_base", "", $basePath);

        $destinationPath = $basePath.'htdocs/img/before-after/'.$image_name;

        file_put_contents($destinationPath, $data);

        return response()->json(['status' => 1, 'message' => "Before Image uploaded successfully", 'name' => $image_name]);
    }

    public function afterCrop(Request $request){
        $data = $request->image;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $image_name = time() . '.png';

        $basePath = base_path();

        $basePath = str_replace("app_base", "", $basePath);

        $destinationPath = $basePath.'htdocs/img/before-after/'.$image_name;

        file_put_contents($destinationPath, $data);

        return response()->json(['status' => 1, 'message' => "After Image uploaded successfully", 'name' => $image_name]);
    }
}

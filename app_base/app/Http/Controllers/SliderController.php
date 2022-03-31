<?php

namespace App\Http\Controllers;

use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->get();

        return View::make('dashboard.sliders.view')->with(compact('sliders'));
    }

    public function create()
    {
        return View::make('dashboard.sliders.create');
    }

    public function store(StoreSliderRequest $request)
    {
        $sort_order = Slider::all()->count() + 1;

        Slider::create([
            'title' => $request->title,
            'text' => $request->text,
            'button_text' => $request->button_text,
            'button_path' => $request->button_path,
            'image_path' => '/img/sliders/'.$request->image_name,
            'sort_order' => $sort_order,
            'enabled' => 1,
        ]);

        Session::flash('message', 'Successfully created slide!');
        return Redirect::to('dashboard/sliders');
    }

    public function show($id)
    {
        //
    }

    public function edit(Slider $slider)
    {
        return View::make('dashboard.sliders.edit')->with(compact('slider'));
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        if ($request->image_name != null){
            $image_name = '/img/sliders/'.$request->image_name;
        } else {
            $image_name = $slider->image_path;
        }

        $slider->update([
            'title' => $request->title,
            'text' => $request->text,
            'button_text' => $request->button_text,
            'button_path' => $request->button_path,
            'image_path' => $image_name
        ]);

        Session::flash('message', 'Successfully updated slide!');
        return Redirect::to('dashboard/sliders');
    }

    public function destroy(Slider $slider)
    {
        $sortSliders = Slider::where('sort_order', '>', $slider->sort_order)->get();

        foreach ($sortSliders as $sortSlider){
            $sort_order = $sortSlider->sort_order - 1;
            $sortSlider->update([
                'sort_order' => $sort_order
            ]);
        }

        $path = public_path("/").$slider->image_path;

        if(File::exists($path)){
            File::delete($path);
        }

        $slider->delete();
        Session::flash('message', 'Successfully deleted slide!');
        return Redirect::to('dashboard/sliders');
    }

    public function sort(Request $request)
    {
        $sliders = Slider::all();

        foreach ($sliders as $slider) {
            foreach ($request->order as $order) {
                if ($order['id'] == $slider->id) {
                    $slider->update(['sort_order' => $order['position']]);
                }
            }
        }

        return response('Slider Order Updated Successfully.', 200);
    }

    public function enable(Slider $slider){
        $slider->update([
            'enabled' => 1
        ]);

        Session::flash('message', 'Successfully enabled slide!');
        return Redirect::to('dashboard/sliders');
    }

    public function disable(Slider $slider){
        $slider->update([
            'enabled' => 0
        ]);

        Session::flash('message', 'Successfully disabled slide!');
        return Redirect::to('dashboard/sliders');
    }

    public function crop(Request $request){
        $data = $request->image;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $image_name = time() . '.png';
        $path = public_path() . "/img/sliders/" . $image_name;

        file_put_contents($path, $data);

        return response()->json(['status' => 1, 'message' => "Image uploaded successfully", 'name' => $image_name]);
    }
}

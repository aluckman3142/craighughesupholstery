<?php

namespace App\Http\Controllers;

use App\Http\Requests\Testimonial\StoreTestimonialRequest;
use App\Http\Requests\Testimonial\UpdateTestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();

        return View::make('dashboard.testimonials.view')->with(compact('testimonials'));
    }

    public function create()
    {
        return View::make('dashboard.testimonials.create');
    }

    public function store(StoreTestimonialRequest $request)
    {
        $sort_order = Testimonial::all()->count() + 1;

        Testimonial::create([
            'customer_name' => $request->customer_name,
            'customer_location' => $request->customer_location,
            'text' => $request->text,
            'image_path' => '/img/testimonials/'.$request->image_name,
            'sort_order' => $sort_order,
            'enabled' => 1,
        ]);

        Session::flash('message', 'Successfully created testimonial!');
        return Redirect::to('dashboard/testimonials');
    }

    public function show($id)
    {
        //
    }

    public function edit(Testimonial $testimonial)
    {
        return View::make('dashboard.testimonials.edit')->with(compact('testimonial'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        if ($request->image_name != null){
            $image_name = '/img/testimonials/'.$request->image_name;
        } else {
            $image_name = $testimonial->image_path;
        }

        $testimonial->update([
            'customer_name' => $request->customer_name,
            'customer_location' => $request->customer_location,
            'text' => $request->text,
            'image_path' => $image_name,
        ]);

        Session::flash('message', 'Successfully updated testimonial!');
        return Redirect::to('dashboard/testimonials');
    }

    public function destroy(Testimonial $testimonial)
    {
        $sortTestimonials = Testimonial::where('sort_order', '>', $testimonial->sort_order)->get();

        foreach ($sortTestimonials as $sortTestimonial){
            $sort_order = $sortTestimonial>sort_order - 1;
            $sortTestimonial->update([
                'sort_order' => $sort_order
            ]);
        }

        $path = public_path("/").$testimonial->image_path;

        if(File::exists($path)){
            File::delete($path);
        }

        $testimonial->delete();

        Session::flash('message', 'Successfully deleted testimonial!');
        return Redirect::to('dashboard/testimonials');

    }

    public function sort(Request $request)
    {
        $testimomnials = Testimonial::all();

        foreach ($testimomnials as $testimonial) {
            foreach ($request->order as $order) {
                if ($order['id'] == $testimonial->id) {
                    $testimonial->update(['sort_order' => $order['position']]);
                }
            }
        }

        return response('Testimonial Order Updated Successfully.', 200);
    }

    public function enable(Testimonial $testimonial){
        $testimonial->update([
            'enabled' => 1
        ]);

        Session::flash('message', 'Successfully enabled testimonial!');
        return Redirect::to('dashboard/testimonials');
    }

    public function disable(Testimonial $testimonial){
        $testimonial->update([
            'enabled' => 0
        ]);

        Session::flash('message', 'Successfully disabled testimonial!');
        return Redirect::to('dashboard/testimonials');
    }

    public function crop(Request $request){
        $data = $request->image;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $image_name = time() . '.png';
        $path = public_path() . "/img/testimonials/" . $image_name;

        file_put_contents($path, $data);

        return response()->json(['status' => 1, 'message' => "Image uploaded successfully", 'name' => $image_name]);
    }
}

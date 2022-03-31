<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccommodationImage\StoreAccommodationImageRequest;
use App\Http\Requests\AccommodationImage\UpdateAccommodationImageRequest;
use App\Models\AccommodationImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AccommodationImageController extends Controller
{

    public function index()
    {
        $accommodationImages = AccommodationImage::orderBy('sort_order')->get();

        return View::make('dashboard.accommodation-images.view')
        ->with(compact('accommodationImages'));
    }

    public function create()
    {
        return View::make('dashboard.accommodation-images.create');
    }

    public function store(StoreAccommodationImageRequest $request)
    {
        $sort_order = AccommodationImage::all()->count() + 1;

        AccommodationImage::create([
            'title' => $request->title,
            'description' => $request->description,
            'thumb' => '/img/accommodation-images/thumbs/'.$request->image_name,
            'src' => '/img/accommodation-images/large/'.$request->image_name,
            'sort_order' => $sort_order,
            'enabled' => 1,
        ]);

        Session::flash('message', 'Successfully created category!');
        return Redirect::to('dashboard/accommodation-images');
    }

    public function show($id)
    {
        //
    }

    public function edit(AccommodationImage $accommodationImage)
    {
        return View::make('dashboard.accommodation-images.edit')->with(compact('accommodationImage'));
    }

    public function update(UpdateAccommodationImageRequest $request, AccommodationImage $accommodationImage)
    {
        if ($request->image_name != null){
            $thumb_name = '/img/accommodation-images/thumbs/'.$request->image_name;
            $image_name = '/img/accommodation-images/large/'.$request->image_name;
        } else {
            $thumb_name = $accommodationImage->thumb;
            $image_name = $accommodationImage->src;
        }

        $accommodationImage->update([
            'title' => $request->title,
            'description' => $request->description,
            'thumb' => $thumb_name,
            'src' => $image_name,
            'enabled' => 1,
        ]);

        Session::flash('message', 'Successfully updated accommodation image!');
        return Redirect::to('dashboard/accommodation-images');
    }

    public function destroy(AccommodationImage $accommodationImage)
    {
        $sortAccommodationImages = AccommodationImage::where('sort_order', '>', $accommodationImage->sort_order)->get();

        foreach ($sortAccommodationImages as $sortAccommodationImage){
            $sort_order = $sortAccommodationImage->sort_order - 1;
            $sortAccommodationImage->update([
                'sort_order' => $sort_order
            ]);
        }

        $path = public_path("/").$accommodationImage->src;

        if(File::exists($path)){
            File::delete($path);
        }

        $thumb = public_path("/").$accommodationImage->thumb;

        if(File::exists($thumb)){
            File::delete($thumb);
        }

        $accommodationImage->delete();

        Session::flash('message', 'Successfully deleted accommodation image!');
        return Redirect::to('dashboard/accommodation-images');
    }

    public function sort(Request $request)
    {
        $accommodationImages = AccommodationImage::all();

        foreach ($accommodationImages as $accommodationImage) {
            foreach ($request->order as $order) {
                if ($order['id'] == $accommodationImage->id) {
                    $accommodationImage->update(['sort_order' => $order['position']]);
                }
            }
        }

        return response('Accommodation Image Order Updated Successfully.', 200);
    }

    public function enable(AccommodationImage $accommodationImage){
        $accommodationImage->update([
            'enabled' => 1
        ]);

        Session::flash('message', 'Successfully enabled accommodation image!');
        return Redirect::to('dashboard/accommodation-images');
    }

    public function disable(AccommodationImage $accommodationImage){
        $accommodationImage->update([
            'enabled' => 0
        ]);

        Session::flash('message', 'Successfully disabled accommodation image!');
        return Redirect::to('dashboard/accommodation-images');
    }

    public function crop(Request $request){
        $data = $request->image;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $image_name = time() . '.png';

        $basePath = base_path();

        $basePath = str_replace("app_base", "", $basePath);

        $destinationPath = $basePath.'htdocs/img/accommodation-images/thumbs/' . $image_name;

        file_put_contents($destinationPath, $data);

        $data2 = $request->original;

        list($type, $data2) = explode(';', $data2);
        list(, $data2)      = explode(',', $data2);

        $data2 = base64_decode($data2);
        $image_name2 = time() . '.png';

        $destinationPath2 = $basePath.'htdocs/img/accommodation-images/large/' . $image_name2;

        file_put_contents($destinationPath2, $data2);

        return response()->json(['status' => 1, 'message' => "Image uploaded successfully", 'name' => $image_name]);
    }
}

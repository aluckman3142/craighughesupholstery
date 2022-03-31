<?php

namespace App\Http\Controllers;

use App\Models\AccommodationImage;
use App\Models\CategoryImage;
use App\Models\FabricLink;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $sliders = Slider::where('enabled', 1)->orderBy('sort_order')->get();

        $categories = Category::where('enabled', 1)->orderBy('sort_order')->get();

        $testimonials = Testimonial::where('enabled', 1)->orderBy('sort_order')->get();

        $items = CategoryImage::where('enabled', 1)->orderBy(DB::raw('RAND()'))->limit(12)->get();

        return view('welcome')->with(compact('sliders', 'categories', 'testimonials', 'items'));
    }

    public function privacy()
    {
        return view('privacy-policy');
    }

    public function returns()
    {
        return view('returns-policy');
    }

    public function about()
    {
        return view('about-us');
    }

    public function news()
    {
        $posts = Post::whereHas('images')->where('enabled', 1)->get();

        return view('news')->with(compact('posts'));
    }

    public function videos()
    {
        return view('videos');
    }

    public function upholsteryClasses()
    {
        return view('upholstery-classes');
    }

    public function accommodation()
    {
        $items = AccommodationImage::where('enabled', 1)->orderBy('sort_order')->get();

        return view('accommodation')->with(compact('items'));
    }

    public function fabrics()
    {
        $fabricLinks = FabricLink::where('enabled', 1)->orderBy('sort_order')->get();

        return view('fabrics')->with(compact('fabricLinks'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function shop()
    {
        $products = Product::where('enabled', 1)->orderBy('sort_order')->get();

        return view('shop')->with(compact('products'));
    }

    public function thankyou()
    {
        if (! session()->has('success_message')) {
            return redirect('/');
        }
        return view('thankyou');
    }
}

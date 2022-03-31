<?php

namespace App\Http\Controllers;

use App\Models\CategoryImage;
use App\Models\Enquiry;
use App\Models\Order;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\UpholsteryClassEnquiry;

class DashboardController extends Controller
{

    public function index()
    {
        $enquiries = Enquiry::where('status', 'unread')->count();
        $upholsteryEnquiries = UpholsteryClassEnquiry::where('status', 'unread')->count();
        $categories = Category::where('enabled', 1)->count();
        $slides = Slider::where('enabled', 1)->count();
        $orders = Order::where('status', 'Processing')->count();
        $posts = Post::where('enabled', 1)->count();

        return view('dashboard')->with(compact('enquiries','upholsteryEnquiries', 'categories', 'slides', 'orders', 'posts'));
    }
}

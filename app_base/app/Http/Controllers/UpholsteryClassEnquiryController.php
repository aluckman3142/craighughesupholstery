<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpholsteryClassEnquiry\StoreUpholsteryClassEnquiryRequest;
use App\Models\UpholsteryClassEnquiry;
use App\Mail\UpholsteryEnquiryMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UpholsteryClassEnquiryController extends Controller
{
    public function index()
    {
        $enquiries = UpholsteryClassEnquiry::orderBy('created_at', 'desc')->get();

        return View::make('dashboard.upholstery-enquiries.view')->with(compact('enquiries'));
    }

    public function store(StoreUpholsteryClassEnquiryRequest $request)
    {
        $image = $request->file('upload');

        $input['upload'] = time().'.'.$image->extension();

        $basePath = base_path();

        $basePath = str_replace("app_base", "", $basePath);

        $destinationPath = $basePath.'htdocs/img/upholstery-class-enquiries';

        $imgFile = Image::make($image->getRealPath());

        $imgFile->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['upload']);

        $fileName = time().'_'.$request->upload->getClientOriginalName();

        if ($request->type){
            $type = $request->type;
        } else {
            $type = 'General';
        }

        $enquiry = UpholsteryClassEnquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject'=> $request->subject,
            'project_description' => $request->project_description,
            'days_required' => $request->days_required,
            'width' => $request->width,
            'height' => $request->height,
            'depth' => $request->depth,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $type,
            'status' => 'unread',
            'image' => '/img/upholstery-class-enquiries/'.$input['upload'],
        ]);

        $details = [
            'name' => $enquiry->name,
            'email' => $enquiry->email,
            'subject'=> $enquiry->subject,
            'project_description' => $enquiry->project_description,
            'image' => $enquiry->image,
            'days_required' => $enquiry->days_required,
            'width' => $enquiry->width,
            'height' => $enquiry->height,
            'depth' => $enquiry->depth,
            'start_date' => $enquiry->start_date,
            'end_date' => $enquiry->end_date,
        ];

        Mail::to('enquiries@craighughesupholstery.co.uk')->send(new UpholsteryEnquiryMail($details));

        Session::flash('message', 'Successfully sent enquiry!');
        return Redirect::to('upholstery-classes');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function show(UpholsteryClassEnquiry $upholsteryEnquiry)
    {
        $upholsteryEnquiry->status = 'read';
        $upholsteryEnquiry->save();

        return View::make('dashboard.upholstery-enquiries.show')
            ->with('enquiry', $upholsteryEnquiry);
    }

    public function destroy(UpholsteryClassEnquiry $upholsteryEnquiry)
    {
        $upholsteryEnquiry->delete();
        Session::flash('message', 'Successfully deleted Upholstery Class Enquiry!');
        return Redirect::to('dashboard/upholstery-enquiries');
    }
}

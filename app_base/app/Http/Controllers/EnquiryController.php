<?php

namespace App\Http\Controllers;

use App\Http\Requests\Enquiry\StoreEnquiryRequest;
use App\Mail\EnquiryMail;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EnquiryController extends Controller
{

    public function index()
    {
        $enquiries = Enquiry::orderBy('created_at')->get();

        return View::make('dashboard.enquiries.view')
        ->with(compact('enquiries'));
    }

    public function store(StoreEnquiryRequest $request)
    {
        if ($request->file('upload')) {
            $image = $request->file('upload');

            $input['upload'] = time() . '.' . $image->extension();

            $basePath = base_path();

            $basePath = str_replace("app_base", "", $basePath);

            $destinationPath = $basePath.'htdocs/img/enquiries';

            $imgFile = Image::make($image->getRealPath());

            $imgFile->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['upload']);

            $fileName = time().'_'.$request->upload->getClientOriginalName();
        }

        else {
            $input['upload'] = '';
        }

        if ($request->type){
            $type = $request->type;
        } else {
            $type = 'General';
        }

        $enquiry = Enquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject'=> $request->subject,
            'message' => $request->message,
            'type' => $type,
            'status' => 'unread',
            'image' => '/img/enquiries/'.$input['upload'],
        ]);

        $details = [
            'name' => $enquiry->name,
            'email' => $enquiry->email,
            'subject'=> $enquiry->subject,
            'message' => $enquiry->message,
            'image' => $enquiry->image,
        ];

        Mail::to('enquiries@craighughesupholstery.co.uk')->send(new EnquiryMail($details));

        Session::flash('message', 'Successfully sent enquiry!');
        return Redirect::to('contact');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function show(Enquiry $enquiry)
    {
        $enquiry->status = 'read';
        $enquiry->save();

        return View::make('dashboard.enquiries.show')->with(compact('enquiry'));
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        Session::flash('message', 'Successfully deleted Enquiry!');
        return Redirect::to('dashboard/enquiries');
    }
}

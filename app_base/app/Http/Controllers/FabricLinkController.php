<?php

namespace App\Http\Controllers;

use App\Http\Requests\FabricLink\StoreFabricLinkRequest;
use App\Http\Requests\FabricLink\UpdateFabricLinkRequest;
use App\Models\FabricLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class FabricLinkController extends Controller
{

    public function index()
    {
        $fabricLinks = FabricLink::orderBy('sort_order')->get();

        return View::make('dashboard.fabric-links.view')
        ->with(compact('fabricLinks'));
    }

    public function create()
    {
        return View::make('dashboard.fabric-links.create');
    }

    public function store(StoreFabricLinkRequest $request)
    {
        $sort_order = FabricLink::all()->count() + 1;

        FabricLink::create([
            'title' => $request->title,
            'link' => $request->link,
            'sort_order' => $sort_order,
            'enabled' => 1,
        ]);

        Session::flash('message', 'Successfully created fabric link!');
        return Redirect::to('dashboard/fabric-links');
    }

    public function show()
    {
       //
    }

    public function edit(FabricLink $fabricLink)
    {
        return View::make('dashboard.fabric-links.edit')->with(compact('fabricLink'));
    }

    public function update(UpdateFabricLinkRequest $request, FabricLink $fabricLink)
    {
        $fabricLink->update([
            'title' => $request->title,
            'link'=> $request->link,
        ]);

        Session::flash('message', 'Successfully updated fabric link!');
        return Redirect::to('dashboard/fabric-links');
    }

    public function destroy(FabricLink $fabricLink)
    {
        $sortFabricLinks = FabricLink::where('sort_order', '>', $fabricLink->sort_order)->get();

        foreach ($sortFabricLinks as $sortFabricLink){
            $sort_order = $sortFabricLink->sort_order - 1;
            $sortFabricLink->update([
                'sort_order' => $sort_order
            ]);
        }

        $fabricLink->delete();
        Session::flash('message', 'Successfully deleted fabric link!');
        return Redirect::to('dashboard/fabric-links');

    }

    public function sort(Request $request)
    {
        $fabricLinks = FabricLink::all();

        foreach ($fabricLinks as $fabricLink) {
            foreach ($request->order as $order) {
                if ($order['id'] == $fabricLink->id) {
                    $fabricLink->update(['sort_order' => $order['position']]);
                }
            }
        }

        return response('Fabric Link Order Updated Successfully.', 200);
    }

    public function enable(FabricLink $fabricLink){
        $fabricLink->update([
            'enabled' => 1
        ]);

        Session::flash('message', 'Successfully enabled fabric link!');
        return Redirect::to('dashboard/fabric-links');
    }

    public function disable(FabricLink $fabricLink){
        $fabricLink->update([
            'enabled' => 0
        ]);

        Session::flash('message', 'Successfully disabled fabric link!');
        return Redirect::to('dashboard/fabric-links');
    }
}

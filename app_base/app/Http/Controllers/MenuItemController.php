<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItem\StoreMenuItemRequest;
use App\Http\Requests\MenuItem\UpdateMenuItemRequest;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class MenuItemController extends Controller
{

    public function index()
    {
        $menuItemsAdmin = MenuItem::all();

        return View::make('dashboard.menu-items.view')->with(compact('menuItemsAdmin'));
    }

    public function create()
    {
        return View::make('dashboard.menu-items.create');
    }

    public function store(StoreMenuItemRequest $request)
    {
        $sort_order = MenuItem::all()->count() + 1;

        MenuItem::create([
            'name' => $request->name,
            'url_path' => $request->url_path,
            'sort_order' => $sort_order,
            'enabled' => 1,
        ]);

        Session::flash('message', 'Successfully created menu item!');
        return Redirect::to('dashboard/menu-items');
    }

    public function edit(MenuItem $menuItem)
    {
        return View::make('dashboard.menu-items.edit')->with(compact('menuItem'));
    }

    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem)
    {
        $menuItem->update([
            'name' => $request->name,
            'url_path'=> $request->url_path,
        ]);

        Session::flash('message', 'Successfully updated menu item!');
        return Redirect::to('dashboard/menu-items');
    }

    public function destroy(MenuItem $menuItem)
    {
        $sortMenuItems = MenuItem::where('sort_order', '>', $menuItem->sort_order)->get();

        foreach ($sortMenuItems as $sortMenuItem){
            $sort_order = $sortMenuItem->sort_order - 1;
            $sortMenuItem->update([
                'sort_order' => $sort_order
            ]);
        }

        $menuItem->delete();
        Session::flash('message', 'Successfully deleted menu item!');
        return Redirect::to('dashboard/menu-items');
    }

    public function sort(Request $request)
    {
        $menuItems = MenuItem::all();

        foreach ($menuItems as $menuItem) {
            foreach ($request->order as $order) {
                if ($order['id'] == $menuItem->id) {
                    $menuItem->update(['sort_order' => $order['position']]);
                }
            }
        }

        return response('Menu Item Order Updated Successfully.', 200);
    }

    public function enable(MenuItem $menuItem){
        $menuItem->update([
            'enabled' => 1
        ]);

        Session::flash('message', 'Successfully enabled menu item!');
        return Redirect::to('dashboard/menu-items');
    }

    public function disable(MenuItem $menuItem){
        $menuItem->update([
            'enabled' => 0
        ]);

        Session::flash('message', 'Successfully disabled menu item!');
        return Redirect::to('dashboard/menu-items');
    }
}

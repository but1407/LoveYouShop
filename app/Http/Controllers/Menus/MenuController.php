<?php

namespace App\Http\Controllers\Menus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Components\MenuRecusive;
use App\Models\Menu;
use Illuminate\Support\Str;
use App\Http\Requests\Menu\CreateMenuRequest;
class MenuController extends Controller
{
    private $menu;
    private $menurecusive;
    public function __construct(MenuRecusive $menurecusive, Menu $menu)
    {
        $this->menurecusive = $menurecusive;
        $this->menu = $menu;

    }
    public function index(Request $request)
    {
        $keyword = '';
        if (!empty($request->name)) {
            $keyword = $request->name;
        }

        $menus = $this->menu->getMenu($keyword);
        return view('admin.menus.index', compact('menus'));
    }
    public function create()
    {
        $optionSelect = $this->menurecusive->MenuRecusiveAdd();
        return view('admin.menus.add', compact('optionSelect'));
    }
    public function store(CreateMenuRequest $request)
    {
        $this->menu->create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'slug' => str_slug($request->input('name')),
        ]);
        return redirect()->back()->with('success', 'Successfully created');
    }
    public function edit($id)
    {
        $menu = $this->menu->find($id);

        $optionSelect = $this->menurecusive->MenuRecusiveEdit($menu->parent_id);
        return view('admin.menus.edit', compact('menu', 'optionSelect'));
    }
    public function update($id, Request $request)
    { 
            $this->menu->find($id)->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => str_slug($request->input('name')),
            ]);
            return redirect()->route('admin.menus.index')->with('success', 'Successfully updated');

        
    }
    public function delete($id){
        $menu= $this->menu->where('id', $id)->first();
        if($menu){
            $this->menu->where('id', $id)->orwhere('parent_id', $id)->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        }
        return redirect()->back()->with('error', 'Failed delete');
    }
}
<?php

namespace App\Http\Controllers;

use App\Components\loopMenu;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menu;
    private $loopMenu;
    public function __construct(Menu $menu, loopMenu $loopMenu)
    {
       $this->menu = $menu;
       $this->loopMenu =$loopMenu;
    }

    public function index()
    {   $menus =$this->menu->latest()->paginate(6)->fragment('menus');
        return view('admin.menu.index',compact('menus'));
    }
    public function creat()
    {
        $html=$this->loopMenu->loopMenuAdd();
        return view('admin.menu.add',compact('html'));

    }
    public function store(MenuRequest $request)
    {
        $this->menu->create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name),
        ]);
        return redirect()->route('menus.index');
    }
    public function edit($id)
    {
        $menu =$this->menu->find($id);
        $html =$this->loopMenu->loopMenuEdit($menu->parent_id);
        return view('admin.menu.edit', compact('menu','html'));
    }
    public function update(Request $request, $id)
    {
        $this->menu->find($id)->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name),
        ]);
        return redirect()->route('menus.index');

    }
    public function delete($id)
    {
        $this->menu->find($id)->delete();
        return redirect()->route('menus.index');
    }
}

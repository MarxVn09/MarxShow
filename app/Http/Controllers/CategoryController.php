<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\LoopCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category=$category;
    }
    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $loopCategory= new LoopCategory($data);
        $htmlOption =$loopCategory->categoryLoop($parent_id);
        return $htmlOption;
    }
    public function index(){
        $categories = $this->category->latest()->paginate(6)->fragment('categories');
        return view('admin.category.index',compact('categories'));
    }
    public function creat()
    {
        $htmlOption =$this->getCategory($parent_id='');
        return view('admin.category.add',compact('htmlOption'));
    }
    public function store(CategoryRequest $request)
    {
        $this->category->create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name),
        ]);
        return redirect()->route('categories.index');
    }
    public function edit($id)
    {
        $category =$this->category->find($id);
        $htmlOption =$this->getCategory($category->parent_id);
        return view('admin.category.edit',compact('category','htmlOption'));
    }
    public function update(Request $request,$id)
    {
        $this->category->find($id)->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name),
        ]);
        return redirect()->route('categories.index');
    }
    public function delete($id)
    {

        try {
            $this->category->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Delete success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Error ' . $exception->getMessage() . ' --Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Delete fail'
            ], 500);
        }
    }
}

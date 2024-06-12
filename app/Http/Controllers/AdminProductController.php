<?php

namespace App\Http\Controllers;

use App\Components\loopCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\StoreageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminProductController extends Controller
{
    use StoreageImageTrait;
    private $category;
    private $product;
    private $productImage;
    private $tags;
    private $productTags;
    public function __construct(Category $category , Product $product , Tag $tags , ProductTag $productTags , ProductImage $productImage)
    {
        $this->category=$category;
        $this->product=$product;
        $this->tags=$tags;
        $this->productTags=$productTags;
        $this->productImage=$productImage;
    }

    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $loopCategory= new LoopCategory($data);
        $htmlOption =$loopCategory->categoryLoop($parent_id);
        return $htmlOption;
    }
    public function index()
    {
        $products = $this->product->latest()->paginate(6)->fragment('products');
        return view('admin.product.index',compact('products'));
    }
    public function creat()
    {
        $htmlOption =$this->getCategory($parent_id='');
        return view('admin.product.add',compact('htmlOption'));
    }
    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreat = [
                'name'=>$request->name,
                'price'=>$request->price,
                'content'=>$request->contents,
                'inventory'=>$request->inventory,
                'user_id'=>auth()->id(),
                'category_id'=>$request->category_id,
            ];
            $dataUploadFeatuteImage = $this->StoreImageUpload($request,'product_image_path','product');
            if(!empty($dataUploadFeatuteImage)){
                $dataProductCreat['feature_image_path']=$dataUploadFeatuteImage['file_path'];
                $dataProductCreat['feature_image_name']=$dataUploadFeatuteImage['file_name'];
            }
            $product=$this->product->create($dataProductCreat);
            // insert image detail
            if($request->hasFile('image_path')){
                foreach ($request->image_path as $fileItem){
                    $dataProductImageDetail = $this->StoreImageUploadMuntiple($fileItem,'product');
                    $product->images()->create([
                            'image_path'=>$dataProductImageDetail['file_path'],
                            'image_name'=>$dataProductImageDetail['file_name'],
                        ]
                    );
                }
            }
            // Insert tags for product
            if(!empty($request->tags)){
                foreach ($request->tags as $tagItem)
                {
                    $tagInsert = $this->tags->firstOrCreate(['name'=>$tagItem]);
                    $tagIds[]=$tagInsert->id;

                }
                $product->tags()->sync($tagIds);
            }


            DB::commit();
            return redirect()->route('product.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message:'.$exception->getMessage() .'Line:'.$exception->getLine());
        }

    }
    public function edit($id)
    {
        $product= $this->product->find($id);
        $htmlOption =$this->getCategory($parent_id=$product->category_id);
        return view('admin.product.edit',compact('htmlOption','product'));
    }
    public function update(Request $request ,$id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name'=>$request->name,
                'price'=>$request->price,
                'content'=>$request->contents,
                'user_id'=>auth()->id(),
                'category_id'=>$request->category_id,
            ];
            $dataUploadFeatuteImage = $this->StoreImageUpload($request,'product_image_path','product');
            if(!empty($dataUploadFeatuteImage)){

                $dataProductUpdate['feature_image_path']=$dataUploadFeatuteImage['file_path'];
                $dataProductUpdate['feature_image_name']=$dataUploadFeatuteImage['file_name'];

            }
            $product=$this->product->find($id)->update($dataProductUpdate);
            // insert image detail
            if($request->hasFile('image_path')){
                $this->productImage->where('product_id',$id)->delete();
                $product=$this->product->find($id);
                foreach ($request->image_path as $fileItem){
                    $dataProductImageDetail = $this->StoreImageUploadMuntiple($fileItem,'product');
                    $product->images()->create([
                            'image_path'=>$dataProductImageDetail['file_path'],
                            'image_name'=>$dataProductImageDetail['file_name'],
                        ]
                    );
                }
            }
            // Insert tags for product
            if(!empty($request->tags)){
                foreach ($request->tags as $tagItem)
                {
                    $tagInsert = $this->tags->firstOrCreate(['name'=>$tagItem]);
                    $tagIds[]=$tagInsert->id;
                }
                $product=$this->product->find($id);
                $product->tags()->sync($tagIds);
            }


            DB::commit();
            return back();
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message:'.$exception->getMessage() .'Line:'.$exception->getLine());
        }
    }
    public function delete($id)
    {
        try {
            $this->product->find($id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'success'
            ],200);
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message:'.$exception->getMessage() .'Line:'.$exception->getLine());
            return response()->json([
                'code'=>500,
                'message'=>'fail'
            ],200);
        }
    }
}

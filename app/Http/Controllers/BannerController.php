<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Traits\StoreageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    private $banner;
    use StoreageImageTrait;
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    public function index()
    {
        $banners =$this->banner->all();
        return view('admin.banner.index',compact('banners'));
    }

    public function creat()
    {
        $first = '';
        $last = '';
        $middle = '';
        if (DB::table('banners')->where('location_in_site', 'first')->exists()) {
            $first = 'disabled';
        }
        if (DB::table('banners')->where('location_in_site', 'middle')->exists()) {
            $middle = 'disabled';
        }
        if (DB::table('banners')->where('location_in_site', 'last')->exists()) {
            $last = 'disabled';
        }
        return view('admin.banner.add', compact('first', 'middle', 'last'));
    }
    public function store(Request $request)
    {
        try {
            $dataInsert =[
                'name'        =>$request->name,
                'location_in_site' =>$request->location_in_site,
            ];
            $dataInsertBanner =$this->StoreImageUpload($request,'image_path','banner');
            if(!empty($dataInsertBanner)){
                $dataInsert['image_name']=$dataInsertBanner['file_name'];
                $dataInsert['image_path']=$dataInsertBanner['file_path'];
            }
            if($request->location_in_site =='first'){
                $dataInsert['break_point']='col-lg-7 offset-lg-4';
            }
            if($request->location_in_site =='middle'){
                $dataInsert['break_point']='col-lg-5';
            }
            if($request->location_in_site =='last'){
                $dataInsert['break_point']='col-lg-7 ';
            }
            $this->banner->create($dataInsert);
            return redirect()->route('banner.index');
        }
        catch (\Exception $exception){
            Log::error('Error'.$exception->getMessage().'--Line: '.$exception->getLine());
        }
    }
    public function edit($id)
    {
       $banner= $this->banner->find($id);
        return view('admin.banner.edit', compact('banner'));
    }
    public function update(Request $request,$id)
    {
        try {
            $dataInsert =[
                'name'        =>$request->name,
            ];
            $dataInsertBanner =$this->StoreImageUpload($request,'image_path','banner');
            if(!empty($dataInsertBanner)){
                $dataInsert['image_name']=$dataInsertBanner['file_name'];
                $dataInsert['image_path']=$dataInsertBanner['file_path'];
            }
            $this->banner->find($id)->update($dataInsert);
            return redirect()->route('banner.index');
        }
        catch (\Exception $exception){
            Log::error('Error'.$exception->getMessage().'--Line: '.$exception->getLine());
        }
    }
    public function delete($id)
    {
        try {
            $this->banner->find($id)->delete();
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

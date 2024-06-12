<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\DeleteTrait;
use App\Traits\StoreageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SliderAdminController extends Controller
{
    use StoreageImageTrait,DeleteTrait;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider=$slider;
    }

    public function index()
    {   $sliders =$this->slider->latest()->paginate('6')->fragment('sliders');
        return view('admin.slider.index',compact('sliders'));
    }
    public function creat()
    {
        return view('admin.slider.add');

    }
    public function store(SliderRequest $request)
    {
        try {
            $dataInsert =[
                'name'        =>$request->name,
                'description' =>$request->description,
            ];
            $dataInsertSlider =$this->StoreImageUpload($request,'image_path','slider');
            if(!empty($dataInsertSlider)){
                $dataInsert['image_name']=$dataInsertSlider['file_name'];
                $dataInsert['image_path']=$dataInsertSlider['file_path'];
            }
            $this->slider->create($dataInsert);
            return redirect()->route('sliders.index');
        }
        catch (\Exception $exception){
            Log::error('Error'.$exception->getMessage().'--Line: '.$exception->getLine());
        }

    }
    public function edit($id)
    {   $slider =$this->slider->find($id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function update(Request $request,$id)
    {
        try {
            $dataUpdate =[
                'name'        =>$request->name,
                'description' =>$request->description,
            ];
            $dataUpdateSlider =$this->StoreImageUpload($request,'image_path','slider');
            if(!empty($dataUpdateSlider)){
                $dataUpdate['image_name']=$dataUpdateSlider['file_name'];
                $dataUpdate['image_path']=$dataUpdateSlider['file_path'];
            }
            $this->slider->find($id)->update($dataUpdate);
            return redirect()->route('sliders.index');
        }
        catch (\Exception $exception){
            Log::error('Error'.$exception->getMessage().'--Line: '.$exception->getLine());
        }
    }
    public function delete($id)
    {
        try {
            $this->slider->find($id)->delete();
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

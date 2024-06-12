<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Traits\DeleteTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingAdminController extends Controller
{
    use DeleteTrait;
    private $setting;
    public function __construct(Setting $setting)
    {
        $this->setting=$setting;
    }
    public function index()
    {
        $settings =$this->setting->latest()->paginate(6)->fragment('setting');
        return view('admin.setting.index',compact('settings'));
    }
    public function creat()
    {
        return view('admin.setting.add');
    }
    public function store(SettingRequest $request)
    {
        $this->setting->create(
            [
                'config_key'=>$request->config_key,
                'config_value'=>$request->config_value,
                'type_setting'=>$request->type
            ]
        );
        return redirect()->route('setting.index');
    }

    public function edit($id)
    {
        $setting =$this->setting->find($id);
        return view('admin.setting.edit',compact('setting'));
    }
    public function update(Request $request, $id)
    {
        $this->setting->find($id)->update([
            'config_key'=>$request->config_key,
            'config_value'=>$request->config_value,
            'type_setting'=>$request->type
        ]);
        return redirect()->route('setting.index');
    }
    public function delete($id)
    {

        try {
            $this->setting->find($id)->delete();
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

<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

trait DeleteTrait
{
public function deleteTrait($model, $id)
{
    try {
        $data=[
            'code' => 200,
            'message' => 'Delete success'
        ];
        $model->find($id)->delete();
        return response()->json($data, 200);
    } catch (\Exception $exception) {
        Log::error('Error ' . $exception->getMessage() . ' --Line: ' . $exception->getLine());
        return response()->json([
            'code' => 500,
            'message' => 'Delete fail'
        ], 500);
    }
}
}

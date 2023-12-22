<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait DeleteModelTrait{
    public function deleteModelTrait($id, $model)
    {
        try{
            $model->find($id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Successfully deleted'
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed deleted'
            ],500);
        }
    }
}
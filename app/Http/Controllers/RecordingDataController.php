<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SaveResData;
use Illuminate\Http\Request;

class RecordingDataController extends Controller
{
    public function index (Request $request)
    {

        $json = $request->json()->all();
        foreach ($json as $item) {
            $saveData = new SaveResData();
            foreach ($item as $key => $value) {
                $saveData->$key = $value;
            }
            $saveData->save();

        }
        return response()->json($json);
    }
}

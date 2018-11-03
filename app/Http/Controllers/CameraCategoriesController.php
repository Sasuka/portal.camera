<?php

namespace App\Http\Controllers;

use App\CameraCategories;
use App\Helpers\Common as ResponseFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CameraCategoriesController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the camera categories
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listCameraCate = CameraCategories::all();
        return response()->json(ResponseFormat::formatData(200, 'Get list categories', $listCameraCate));

    }

    /**
     * Show the form for creating a new camera category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'type_name' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(ResponseFormat::formatData(406, $validator->errors()));
            }
            $cameraCate = new CameraCategories();
            $cameraCate->fill($request->all());
            $cameraCate->save();
            return response()->json(ResponseFormat::formatData(200, 'Success!', $cameraCate));
        } catch (\Exception $exception) {
            return response()->json(ResponseFormat::formatData(500, $exception->getMessage()));
        }
    }

    /**
     * Store a newly created camera category in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CameraCategories $cameraCategories
     * @return \Illuminate\Http\Response
     */
    public function show($cameraCategories = null)
    {
        $cameraCate = CameraCategories::find($cameraCategories);
        if (!$cameraCate)
            return response()->json(ResponseFormat::formatData(403, 'Not found camera with id' . $cameraCategories));
        return response()->json(ResponseFormat::formatData(200, 'Success!', $cameraCate));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CameraCategories $cameraCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $cameraCategories = null)
    {
        try {
            $cameraCate = CameraCategories::find($cameraCategories);
            if (!$cameraCate)
                return response()->json(ResponseFormat::formatData(403, 'Not found camera with id' . $cameraCategories));
            if (!$this->update($request, $cameraCate))
                return response()->json(ResponseFormat::formatData(200, 'Failed!', $cameraCate));
            return response()->json(ResponseFormat::formatData(200, 'Success!', $cameraCate));
        } catch (\Exception $exception) {
            return response()->json(ResponseFormat::formatData(500, $exception->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\CameraCategories $cameraCategories
     * @return \Illuminate\Http\Response
     */
    public function update($request, CameraCategories $cameraCategories)
    {
        if ($cameraCategories->update($request->all()))
            return true;
        else
            return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CameraCategories $cameraCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $cameraCategories = null)
    {
        try {
            $cameraCate = CameraCategories::find($cameraCategories);
            if (!$cameraCate)
                return response()->json(ResponseFormat::formatData(403, 'Not found camera with id' . $cameraCategories));
            if (!$cameraCate->update(['deleted' => 1]))
                return response()->json(ResponseFormat::formatData(200, 'Failed!', $cameraCate));
            return response()->json(ResponseFormat::formatData(200, 'Success!', $cameraCate));
        } catch (\Exception $exception) {
            return response()->json(ResponseFormat::formatData(500, $exception->getMessage()));
        }
    }
}

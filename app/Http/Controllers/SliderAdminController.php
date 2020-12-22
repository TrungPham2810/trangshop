<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Traits\StoreageImageTrait;

class SliderAdminController extends Controller
{
    use StoreageImageTrait;
    protected $slider;

    public function __construct(
        Slider $slider
    ) {
        $this->slider = $slider;
    }

    public function index()
    {
        $data = $this->slider->latest()->paginate(10);
        return view('admin.slider.list', compact('data'));
    }

    public function create()
    {
        return view('admin.slider.add');
    }

    public function store(SliderAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataUpload = $this->storageImgUpload($request, 'image', 'slider');
            $dataInsert = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            if (!empty($dataUpload)) {
                $dataInsert['image_name'] = $dataUpload['file_name'];
                $dataInsert['image_path'] = $dataUpload['file_path'];
            } else {
                return redirect()->route('slider.add');
            }

            $this->slider->create($dataInsert);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('slider.index');
    }

    public function edit($id)
    {
        try {
            $slider = $this->slider->find($id);
            if ($slider->id) {
                return view('admin.slider.edit', compact('slider'));
            }
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('slider.index');
    }

    public function update($id, SliderUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataUpload = $this->storageImgUpload($request, 'image', 'slider');
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            if (!empty($dataUpload)) {
                $dataUpdate['image_name'] = $dataUpload['file_name'];
                $dataUpdate['image_path'] = $dataUpload['file_path'];
            }
            $this->slider->find($id)->update($dataUpdate);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('slider.index');
    }

    public function delete($id)
    {
        if($id) {
            try {
                $slider = $this->slider->find($id);
                $slider->delete();
                $message = 'Delete slider success.';
                return response()->json([
                    'code' =>200,
                    'message' => $message
                ], 200);
            } catch (\Exception $e) {
                $message = 'Error: '.$e->getMessage();
                return response()->json([
                    'code' =>500,
                    'message' => $message
                ]);
            }
        } else {
            $message = 'Error: Can\'t found slider to delete ';
            return response()->json([
                'code' =>500,
                'message' => $message
            ]);
        }
    }
}

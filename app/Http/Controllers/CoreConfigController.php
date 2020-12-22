<?php

namespace App\Http\Controllers;

use App\CoreConfig;
use App\Http\Requests\CoreConfigAddRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CoreConfigController extends Controller
{
    protected $coreConfig;

    public function __construct(
        CoreConfig $coreConfig
    ) {
        $this->coreConfig = $coreConfig;
    }

    public function index()
    {
        $data = $this->coreConfig->latest()->paginate(10);
        return view('admin.coreconfig.list', compact('data'));
    }

    public function create()
    {
        return view('admin.coreconfig.add');
    }

    public function store(CoreConfigAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataInsert = [
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
            ];
            $this->coreConfig->create($dataInsert);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('config.index');
    }

    public function edit($id)
    {
        try {
            $config = $this->coreConfig->find($id);
            if ($config->id) {
                return view('admin.coreconfig.edit', compact('config'));
            }
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('config.index');
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
            ];
            $this->coreConfig->find($id)->update($dataUpdate);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('config.index');
    }

    public function delete($id)
    {
        if($id) {
            try {
                $slider = $this->coreConfig->find($id);
                $slider->delete();
                $message = 'Delete core-config success.';
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
            $message = 'Error: Can\'t found coreConfig to delete ';
            return response()->json([
                'code' =>500,
                'message' => $message
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Setting\CreateSettingRequest;
use App\Traits\DeleteModelTrait;
use App\Models\Setting;
class SettingController extends Controller
{
    use DeleteModelTrait;
    private $setting;
    public function __construct(Setting $setting){
        $this->setting = $setting;
    }
    public function index(Request $request){
        $keyword = '';
        if (!empty($request->config_key)) {
            $keyword = $request->config_key;
        }

        $settings = $this->setting->getSetting($keyword);
        return view('admin.setting.index',compact('settings'));

    }
    public function create(){
        return view('admin.setting.add');
    }
    public function store(CreateSettingRequest $request)
    {
        $this->setting->create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type'=>$request->type,
        ]);
        return redirect()->back()->with('success', 'Created Successfully');
    }
    public function edit($id){
        $setting = $this->setting->find($id);
        return view('admin.setting.edit',compact('setting'));
    }
    public function update($id,Request $request){
        $this->setting->find($id)->update([
           'config_key' => $request->config_key,
            'config_value' => $request->config_value,
        ]);
        return redirect()->route('admin.settings.index')->with([
            'success', 'Updated successfully'
        ]);
    }
     public function delete($id){
        return $this->deleteModelTrait($id, $this->setting);
    }
}
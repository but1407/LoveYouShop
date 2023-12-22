<?php

namespace App\Http\Controllers\Admin\Sliders;

use App\Http\Controllers\Controller;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use App\Http\Requests\Slider\CreateSliderRequest;
use App\Models\Slider;
class SliderController extends Controller
{
    use StorageImageTrait;

    private $slider;
    public function __construct(Slider $slider){
        $this->slider = $slider;

    }
    public function index(Request $request){
        $keyword = '';
        if (!empty($request->name)) {
            $keyword = $request->name;
        }

        $sliders = $this->slider->getSlider($keyword);
        return view('admin.slider.index',compact('sliders'));
    }
    public function create(){
        return view('admin.slider.add');
    }
    public function store(Request $request){
        // return view('admin.slider.add');
        $dataInsert = [
            'name'=> $request->name,
            'description'=>$request->description
        ];
        $dataImageSlider = $this->storageImageUpload($request,'image_path','slider');
        if(!empty($dataImageSlider)){
            $dataInsert['image_name'] = $dataImageSlider['file_name'];
            $dataInsert['image_path'] = $dataImageSlider['file_path'];
        
        }
        $this->slider->create($dataInsert);
        return redirect()->back()->with('success', 'Created Successfully');
    }
    public function edit($id){
        $slider = $this->slider->find($id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function update($id, CreateSliderRequest $request){
        $dataUpdate = [
            'name'=> $request->name,
            'description'=>$request->description
        ];
        $dataImageSlider = $this->storageImageUpload($request,'image_path','slider');
        if(!empty($dataImageSlider)){
            $dataUpdate['image_name'] = $dataImageSlider['file_name'];
            $dataUpdate['image_path'] = $dataImageSlider['file_path'];
        
        }
        $this->slider->find($id)->update($dataUpdate);
        return redirect()->back()->with('success', 'Created Successfully');
    }
    public function delete($id){
        return $this->deleteModelTrait($id, $this->slider);

    }
}
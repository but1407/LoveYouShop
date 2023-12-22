<?php

namespace App\Services;

use App\Components\Recusive;
use App\Models\Category;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Session;


class CategoriesService
{
    private $category;

    public function __construct(Category $category )
    {

        $this->category = $category;

    }
    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOptions = $recusive->categoryrecusive($parentId);
        return $htmlOptions;
    }
    public function create($request)
    {
        try{
            Category::create([ //tạo danh mục
                'name'=>$request->input('name'),
                'parent_id'=>$request->input('parent_id'),
                'slug'=> str_slug($request->input('name')),
            ]);
            Session::flash('success','create dashboard successfully');//tạo message khi tạo dashboard thành công bằng session flash
        }catch(\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    public function delete($id)
    {
        $category = Category::where('id', $id)->first();
        if($category){
            return Category::where('id',$id)->orwhere('parent_id',$id)->delete();
        }
        return false;
    }
    public function update($id,$category, $request)
    {
        try{
            if ($category->parent_id != $id) {
                $category = $category->find($id);
                $category->update([
                    'name' => $request->name,
                    'parent_id' => $request->parent_id,
                    'slug' => str_slug($request->name),
                ]);
                Session::flash('success', 'update successfully');
            }
        }catch(\Exception $err){
            Session::flash('error', $err->getMessage());

            return false;
        }
        return true;
    }

}
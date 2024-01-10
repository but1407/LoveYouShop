<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recusive;
use Illuminate\Support\Str;
use App\Services\CategoriesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\Category\CreateFormRequest;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $category;
    private $categoriesService;
    public function __construct(Category $category,CategoriesService $categoriesService )
    {
        $this->categoriesService = $categoriesService;
        $this->category = $category;
    }
    public function index(Request $request){

        // $categories = $this->category->orderBy('updated_at','asc')->paginate(20);
        $keyword = '';
        if (!empty($request->name)) {
            $keyword = $request->name;
        }
        
        $categories = $this->category->getCategory($keyword);
        return view('admin.category.index',compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOptions = $this->categoriesService->getCategory($parentId ='');
        return view('admin.category.add',compact('htmlOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFormRequest $request)
    {
        $result = $this->categoriesService->create($request);
        // if ($result) {
        //     Session::flash('success','create dashboard successfully');//tạo message khi tạo dashboard thành công bằng session flash
            
        // }
        return redirect()->back()->with('success','create dashboard successfully');
        // return response()->json([
        //     'message' => '1'
        // ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category =$this->category->find($id);
        $htmlOptions = $this->categoriesService->getCategory($category->parent_id);

        return view('admin.category.edit',compact('category','htmlOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update($id,Category $category,CreateFormRequest $request)
    {
        $result = $this->categoriesService->update($id,$category,$request);
        
        return redirect()->route('categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete($id,Request $request)
    {
        $result = $this->categoriesService->delete($id,$request);
        if($result){
            Session::flash('success',"Xóa thành công thư mục");
            return redirect()->route('categories.index');

        }
        Session::flash('success',"Xóa không được thư mục");
        return redirect()->back();
    }
    
}
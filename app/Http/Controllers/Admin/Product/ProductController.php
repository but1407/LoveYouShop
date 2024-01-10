<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;

use App\Http\Requests\Product\CreateProductRequest;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use App\Services\CategoriesService;
use App\Services\Product\ProductService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Storage;

class ProductController extends Controller
{
    private $categoryservice;
    private $productimage;
    private $product;
    private $productservice;
    private $producttag;
    public function __construct(ProductTag $producttag,Product $product,ProductService $productservice,CategoriesService $categoryservice,ProductImage $productimage){
        $this->product = $product;
        $this->categoryservice = $categoryservice;
        $this->productservice = $productservice;
        $this->productimage = $productimage;
        $this->producttag = $producttag;
    }
    public function index(Request $request){
        $filters = [];
        if (!empty($request->name)) {
            $last_name = $request->name;
            $filters[] = ['products.name', '=', $last_name];
        }
        $products = $this->product->getProduct($filters);
        return view('admin.product.index',compact('products'));
    }
    public function create(){
        $htmlOptions = $this->categoryservice->getCategory($parentId ='');
        return view('admin.product.add',compact('htmlOptions'));
    }
    public function store(CreateProductRequest $request){
        try {
            DB::beginTransaction();
            // Create data
            $dataUploadFeatureImage = $this->productservice->store($request);
            $product = $this->product->create($dataUploadFeatureImage);

            // image upload
            if ($request->hasFile('image_path')) {
                $storeImage= $this->productservice->storeImageMultiple($request,$product);
            }
            //tags
            if(!empty($request->tags)){
                $tagIds=$this->productservice->storeTags($request);
                $product->tags()->attach($tagIds);
            }
            DB::commit();
            return redirect()->route('admin.products.create')->with('success','Successfully created');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: '. $e->getMessage() . '  Line: ' . $e->getLine());
            return redirect()->route('admin.products.create')->with('error','Failed created');
        }
    }
    public function edit($id){
        $product = $this->product->find($id);
        $htmlOptions = $this->categoryservice->getCategory($product->category_id);

        return view('admin.product.edit',compact('htmlOptions','product'));
    }
    public function update(CreateProductRequest $request,$id){
         try {
            DB::beginTransaction();
            // Create data
            $dataUploadFeatureImage = $this->productservice->store($request);
            $product = $this->product->find($id)->update($dataUploadFeatureImage);
            $product = $this->product->find($id);

            // image upload
            if ($request->hasFile('image_path')) {
                $this->productimage->where('product_id',$id)->delete();
               $storeImage= $this->productservice->storeImageMultiple($request,$product);
            }
            //tags
            if(!empty($request->tags)){
                $tagIds=$this->productservice->storeTags($request);
                $product->tags()->sync($tagIds);
            }
            DB::commit();
            return redirect()->route('admin.products.index')->with('success','Successfully Updated Products');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: '. $e->getMessage() . '  Line: ' . $e->getLine());
            return redirect()->route('admin.products.create')->with('error','Failed Upadated');
        }
    }
    public function delete($id){
        try {
            $product = $this->product->find($id)->delete();
            if($product){
                $this->productimage->where('product_id',$id)->delete();
                $this->producttag->where('product_id',$id)->delete();

            }
            return response()->json([
                'status' => 200,
                'message' => "delete successfully"
            ],200);
        } catch (\Exception $e) {
            Log::error('Message: '. $e->getMessage() . '  Line: ' . $e->getLine());
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ],500);
        }
    }
}
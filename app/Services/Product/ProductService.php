<?php

namespace App\Services\Product;

use App\Components\Recusive;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\ProductTag;

use App\Traits\StorageImageTrait;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
class ProductService{
    use StorageImageTrait;
     private $category;
    private $tag;
    private $producttag;
    private $product;

    
      public function __construct(Category $category,Tag $tag,ProductTag $producttag, Product $product)
    {
        $this->producttag = $producttag;
        $this->tag = $tag;
        $this->product = $product;
        $this->category = $category;

    }
    public function getProduct($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOptions = $recusive->categoryrecusive($parentId);
        
        return $htmlOptions;
    }
    public function store($request){
        $dataProductCreate = [
            'name' => $request->name,
            'price' => $request->price,
            'content' => $request->contents,
            'user_id' =>auth()->id(),
            'category_id' => $request->category_id
        ];
        $data = $this->storageImageUpload($request,'feature_image_path','product');
        if(!empty($data)){
            $dataProductCreate['feature_image_name'] = $data['file_name'];
            $dataProductCreate['feature_image_path'] = $data['file_path'];
        }
        return $dataProductCreate;
    }
    public function storeImageMultiple($request, $product){
        // Insert data to product_image
        foreach($request->file('image_path') as $fileItem){
            $dataProductImageDetail = $this->storageImageUploadMultiple($fileItem,'product');
            $product->images()->create([
                'image_path'=>$dataProductImageDetail['file_path'],
                'image_name'=>$dataProductImageDetail['file_name'],
            ]);
        }
    }
    public function storeTags($request){
        foreach($request->tags as $tagItem){
            $tagIntance = $this->tag->firstOrCreate([
                'name' => $tagItem,
            ]);
            $tagIds[] = $tagIntance->id;
        }
        return $tagIds;
        
    }
}
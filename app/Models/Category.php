<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = ['name', 'parent_id','slug','description','image_link','status'];

    public function getCategory($keywords =null){
        $categories = Category::orderBy('created_at', 'asc');

        if (!empty($keywords)) {
            $categories = $categories->where(function ($q) use ($keywords) {
                $q->orwhere('name','like','%'.$keywords.'%');
            });
        }

        // $categories = $categories->get();
        $categories = $categories -> paginate(20);

        return $categories;
    }
    public function getAll(){
        $categories = DB::table($this->table)->orderBy('name','asc')->get();
        return $categories;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','parent_id','slug'
    ];
    public function getMenu($keywords =null){
        $menus = Menu::orderBy('created_at', 'asc');

        if (!empty($keywords)) {
            $menus = $menus->where(function ($q) use ($keywords) {
                $q->orwhere('name','like','%'.$keywords.'%');
            });
        }
        $menus = $menus -> paginate(10);
        return $menus;
    }
}
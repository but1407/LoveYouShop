<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function getSlider($keywords =null){
        $sliders = Slider::orderBy('created_at', 'asc');

        if (!empty($keywords)) {
            $sliders = $sliders->where(function ($q) use ($keywords) {
                $q->orwhere('name','like','%'.$keywords.'%');
            });
        }
        $sliders = $sliders -> paginate(10);
        return $sliders;
    }
}
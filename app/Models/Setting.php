<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];
     public function getSetting($keywords =null){
        $settings = Setting::orderBy('created_at', 'asc');

        if (!empty($keywords)) {
            $settings = $settings->where(function ($q) use ($keywords) {
                $q->orwhere('confog_key','like','%'.$keywords.'%');
            });
        }
        $settings = $settings -> paginate(10);
        return $settings;
    }
}
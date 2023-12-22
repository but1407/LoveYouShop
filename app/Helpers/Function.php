<?php


use App\Models\Category;
function getAllCategory(){
    return  Category::getAll();
}
<?php

namespace App\Helpers;

//  <td>' . self::active($category->status) . '</td>
class Helper
{
    public static function category($categories, $parent_id =0, $char =''){
        $html = '';
        foreach($categories as $key=>$category){
            if($category ->parent_id == $parent_id){
                $html .= '
                <tr>
                    <td>' . $key + $categories->firstItem() . '</td>
                    <td>' . $char.$category->name . '</td>
                    <td>' . $category->updated_at->toDateString() . '</td>
                    
                    <td>
                        <a class ="btn btn-primary"
                        href="/admin/categories/edit/'.$category->id.'">
                            Edit
                        </a>

                        <a class="btn btn-danger btn-sm"
                        onclick="removeRow('.$category->id.',\'/admin/categories/delete\' )"
                        href="/admin/categories/delete/'.$category->id.'" met>
                            DELETE
                        </a>

                    </td>
                </tr>
                ';
                unset($categories[$key]);
                $html .= self::category($categories, $category->id, $char . '--');
            }
        }
        return $html;
    }
    public static function menu($menus, $parent_id =0, $char =''){
        $html = '';
        foreach($menus as $key=>$menu){
            if($menu ->parent_id == $parent_id){
                $html .= '
                <tr>
                    <td>' . $key + $menus->firstItem() . '</td>
                    <td>' . $char.$menu->name . '</td>
                    <td>' . $menu->updated_at->toDateString() . '</td>
                    
                    <td>
                        <a class ="btn btn-primary"
                        href="/admin/menus/edit/'.$menu->id.'">
                            Edit
                        </a>

                        <a class="btn btn-danger btn-sm"
                        onclick="removeRow('.$menu->id.',\'/admin/menus/delete\' )"
                        href="/admin/menus/delete/'.$menu->id.'" met>
                            DELETE
                        </a>

                    </td>
                </tr>
                ';
                unset($menus[$key]);
                $html .= self::menu($menus, $menu->id, $char . '--');
            }
        }
        return $html;
    }
    public static function product($products ,$status =1){
        $html = '';
        foreach($products as $key=>$product){
            if ($status) {


                $html .= '
                <tr>
                    <td>' . $key + $products->firstItem() . '</td>
                    <td>' . $product->name . '</td>
                    <td>' . optional($product->category)->name . '</td>
                    <td>' . number_format($product->price) . '</td>
                    <td>' . '<img class="product_image_150_100" src="' . $product->feature_image_path . '">' . '</td>

                    <td>
                        <a class ="btn btn-primary"
                        href="/admin/products/edit/' . $product->id . '">
                            Edit
                        </a>
                        <a class="btn btn-danger btn-sm action_delete"
                        href=""
                        data-url="/admin/products/delete/' . $product->id . '" met>
                            DELETE
                        </a>
                    </td>
                </tr>
                ';
                unset($products[$key]);
                $html .= self::product($products);
            }
            $status = 0;
        }
        return $html;
    }
    public static function slider($sliders,$parent_id=0){
        $html = '';
        foreach ($sliders as $key => $slider) {
            if ($slider->parent_id == $parent_id) {
                $html .= '
                <tr>
                    <td>' . $key + $sliders->firstItem() . '</td>
                    <td>' . $slider->name . '</td>
                    <td>' . $slider->description . '</td>
                    <td>' . '<img class="product_image_150_100" src="' . $slider->image_path . '">' . '</td>
                    <td>' . $slider->updated_at->toDateString() . '</td>
                    
                    <td>
                        <a class ="btn btn-primary"
                        href="/admin/sliders/edit/' . $slider->id . '">
                            Edit
                        </a>

                        <a class="btn btn-danger btn-sm action_delete"
                             href=""
                        data-url="/admin/sliders/delete/' . $slider->id . '" met>
                            DELETE
                        </a>

                    </td>
                </tr>
                ';
                unset($sliders[$key]);
                $html .= self::slider($sliders,$slider->id);
            }
        }
        return $html;
    }
    public static function setting($settings, $status =1){
        $html = '';
        foreach($settings as $key=>$setting){
            if ($status == 1) {
                $html .= '
                <tr>
                    <td>' . $key + $settings->firstItem() . '</td>
                    <td>' . $setting->config_key . '</td>
                    <td>' . $setting->config_value . '</td>
                    <td>' . $setting->updated_at->toDateString() . '</td>
                    
                    <td>
                        <a class ="btn btn-primary"
                        href="/admin/settings/edit/' . $setting->id . '?type=' . $setting->type . '">
                            Edit
                        </a>

                        <a class="btn btn-danger btn-sm action_delete"
                             href=""
                        data-url="/admin/settings/delete/' . $setting->id . '" met>
                            DELETE
                        </a>

                    </td>
                </tr>
                ';
                unset($settings[$key]);
                $html .= self::setting($settings);
            }

            $status=0;
        }
        return $html;
    }
     public static function user($users, $status =1){
        $html = '';
        foreach($users as $key=>$user){
            if ($status == 1) {
                $html .= '
                <tr>
                    <td>' . $key + $users->firstItem() . '</td>
                    <td>' . $user->name . '</td>
                    <td>' . $user->email . '</td>   
                    <td>' . $user->updated_at->toDateString() . '</td>
                    <td>
                        <a class ="btn btn-primary"
                        href="/admin/users/edit/' . $user->id . '">
                            Edit
                        </a>
                        <a class="btn btn-danger btn-sm action_delete"
                            href=""
                        data-url="/admin/users/delete/' . $user->id . '" met>
                            DELETE
                        </a>

                    </td>
                </tr>
                ';
                unset($users[$key]);
                $html .= self::user($users);
            }
            $status=0;
        }
        return $html;
    }
    public static function active($active=null):string{
        return $active == 0 ? '<span class="btn btn-danger btn-xs">Chưa kích hoạt</span>' : '<span class="btn btn-success btn-xs">Kích hoạt</span>';
    }

    // public static function button($category)
    // {
    //     if($num==0){
    //         $edit = "route('categories.edit')";
    //         $delete = "route('categories.detele')";
    //         return '<td>
    //             <a href="'. '{{ ' . $edit . ' }}'.'" class="btn btn-default">Edit</a>
    //             <a href="'.'{{ '. $delete .' }}'.'" class="btn btn-danger">Delete</a>
    //         </td>';
    //     }
        
    // }
    // public static function dropdownMenu($route){
    //     $html ='<div class="dropdown show">
    //         <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //             Dropdown link
    //         </a>

    //         <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    //             <a class="dropdown-item" href="#">Action</a>
    //             <a class="dropdown-item" href="#">Another action</a>
    //             <a class="dropdown-item" href="#">Something else here</a>
    //         </div>
    //         </div>';
    //     retunr
    // }
}
<?php

namespace App\Helpers;

class Helper
{
    public static function category($categories, $parent_id =0, $char =''){
        $html = '';
        foreach($categories as $key=>$category){
            if($category ->parent_id == $parent_id){
                $html .= '
                <tr>
                    <td>' . $category->id . '</td>
                    <td>' . $char.$category->name . '</td>
                    <td>' . $category->updated_at . '</td>
                    <td>
                        <a class ="btn btn-primary"
                        href="/categories/edit/'.$category->id.'">
                            Edit
                        </a>

                        <a class="btn btn-danger btn-sm"
                        onclick="removeRow('.$category->id.',\'/categories/delete\' )"
                        href="/categories/delete/'.$category->id.'" met>
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
    public static function active($active=null):string{
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>' : '<span class="btn btn-success btn-xs">YES</span>';
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
}
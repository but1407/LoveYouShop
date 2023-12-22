<?php
namespace App\Components;

use App\Models\Menu;
class MenuRecusive{
    private $html;
    public function __construct(){
        $this->html = '';
    }
    public function MenuRecusiveAdd($parent_id =0,$submark =''){
        $data =Menu::where('parent_id',$parent_id)->get();
        foreach($data as $dataItem){
            $this->html .= '<option value="'.$dataItem->id.'">'. $submark .$dataItem->name.'</option>';
            $this->MenuRecusiveAdd($dataItem->id,$submark .'--');
        }
        return $this->html;
    }
    public function MenuRecusiveEdit($parentEdit,$parent_id =0,$submark =''){
        $data =Menu::where('parent_id',$parent_id)->get();
        foreach($data as $dataItem){
            if($parentEdit == $dataItem->id){

                $this->html .= '<option selected value="'.$dataItem->id.'">'. $submark .$dataItem->name.'</option>';
            }else{
                $this->html .= '<option value="'.$dataItem->id.'">'. $submark .$dataItem->name.'</option>';

            }
            $this->MenuRecusiveEdit($parentEdit,$dataItem->id,$submark .'--');
        }
        return $this->html;
    }
}
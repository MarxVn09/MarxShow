<?php

namespace App\Components;

use App\Models\Menu;

class loopMenu
{
    private $html;
    private $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
        $this->html = '';
    }

    public function loopMenuAdd($parent_id = 0, $text = '')
    {
        $data = $this->menu::where('parent_id', $parent_id)->get();
        foreach ($data as $dataItem) {
            $this->html .= '<option value="' . $dataItem->id . '">' . $text . $dataItem->name . '</option>';
            $this->loopMenuAdd($dataItem->id,$text.'--');
        }
        return $this->html;
    }
    public function loopMenuEdit($parentIdMenu,$parent_id = 0, $text = '')
    {
        $data = $this->menu::where('parent_id', $parent_id)->get();
        foreach ($data as $dataItem) {
            if($parentIdMenu ==$dataItem->id ){
                $this->html .= '<option value="' . $dataItem->id . '" selected>' . $text . $dataItem->name . '</option>';

            }
            if($parentIdMenu ==$dataItem->parent_id ){
                $this->html .= '<option value="' . $dataItem->id . '"disabled  >' . $text . $dataItem->name . '</option>';

            }
            else{
                $this->html .= '<option value="' . $dataItem->id . '">' . $text . $dataItem->name . '</option>';
            }
            $this->loopMenuEdit($parentIdMenu,$dataItem->id,$text.'--');

        }
        return $this->html;
    }
}

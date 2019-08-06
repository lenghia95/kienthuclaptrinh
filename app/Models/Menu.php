<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'admin_menus';
    protected $hidden = [];
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function menuSidebar($parent=0)
    {
        $menus = Menu::where('parent_id', $parent)->orderBy('order','asc')->get();
        $html = '';
        if ($menus) {
            foreach ($menus as $menu) {
                $count = Menu::where('parent_id', $menu->id)->count();

                if ($count > 0) {
                    $html .= '<li class="treeview">';
                    $html .= '<a href="'.url('/'.$menu->url).'"><i class="fa '.$menu->icon.'"></i><span>'.$menu->title.'</span>';
                    $html .= '<i class="fa fa-angle-left pull-right"></i>';
                    $html .= '<ul class="treeview-menu">';
                    $html .= self::menuSidebar($menu->id);
                    $html .= '</ul>';
                    $html .= '</a></li>';
                } else {
                    $html .= '<li class="">';
                    $html .= '<a href="'.url('/'.$menu->url).'"><i class="fa '.$menu->icon.'"></i><span>'.$menu->title.'</span>';
                    $html .= '</a></li>';
                }
            }
        }
        return $html;
    }

    public function listMenus($parent=0)
    {
        $menus = Menu::where('parent_id', $parent)->get();
        $html = '';
        if ($menus) {
            foreach ($menus as $menu) {
                $url = ($menu->url !== '#') ? $menu->url : '';
                $count = Menu::where('parent_id', $menu->id)->count();
                $html .= '<li class="dd-item" data-id="'.$menu->id.'">';
                $html .= '<div class="dd-handle">
                            <i class="fa '.$menu->icon.'"></i>&nbsp;<strong>'.$menu->title.'</strong>
                            <a href="'.url('/'.$url).'" class="dd-nodrag">'.$url.'</a>
                            <span class="pull-right dd-nodrag">
                                <a href="javascript:void(0);" class="edit-menu" data-id="'.$menu->id.'"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);" data-id="'.$menu->id.'" class="tree_branch_delete"><i class="fa fa-trash"></i></a>
                            </span>
                         </div>';
                if ($count > 0) {
                    $html .= '<ol class="dd-list">';
                    $html .= self::listMenus($menu->id);
                    $html .= '</ol>';
                } else {
                    $html .= '</li>';
                }
            }
        }
        return $html;
    }

    public static function listOptionsSelected($menuID, $parent=0, $slas='')
    {
        $menus = Menu::where('parent_id', $parent)->get();
        $html = '';
        if($menus){
            foreach ($menus as $menu){
                $menuSelected = Menu::where('id',$menuID)->first(['parent_id']);
                $selected = ( $menu->id == $menuSelected->parent_id ) ? 'selected= "selected"' : '';
                $html .= '<option value="'.$menu->id.'"'.$selected.'>'.$slas.$menu->title.'</option>';
                $html .= Menu::listOptionsSelected($menuID, $menu->id, $slas . '---');
            }
        }
        return $html;
    }

    public static function listOptions($parent=0, $slas='')
    {
        $menus = Menu::where('parent_id', $parent)->get();
        $html = '';
        if($menus){
            foreach ($menus as $menu){
                $html .= '<option value="'.$menu->id.'">'. $slas . ' ' .$menu->title.'</option>';
                $html .= Menu::listOptions($menu->id, $slas . '---');
            }
        }
        return $html;
    }

    public static function getMenu($id)
    {
        $menu = Menu::where('id',$id)->first();
        if($menu){
            return $menu;
        }
        return '';
    }
}

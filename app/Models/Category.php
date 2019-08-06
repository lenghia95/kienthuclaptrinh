<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\PostCategory;
class Category extends Model
{
    
	
	protected $table = 'categories';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];


    /*============================== Admin ================================= */
    public function getLinks($parent = 0, $slas = '') {
        $html = '';
        $links = Category::where('parent', $parent)->orderBy('sort', 'ASC')->get();
        if ($links) {
            foreach ($links as $link) {
                $html .= '<tr>';
                $html .= '<td>
                             <input type="checkbox" class="minimal">
                        </td>';
                $html .= '<td>' . $link->id . '</td>';
                $html .= '<td>' . $slas . ' ' . $link->name . '</td>';
                $html .= '<td>' . $link->slug . '</td>';
                $html .= '<td align="center"><input type="checkbox"'. ( ($link->status === 1) ? 'checked' : '' ) .' data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="grid-switch-status" data-key="'.$link->id.'" value="'.( ($link->status === 1) ? 1 : 0 ) .'"></td>';
                $html .= '<td>' . $link->sort . '</td>';
                $html .= '<td align="center">';
                $html .= '<a href="'.route('categories.edit',['id'=>$link->id]).'" data-toggle="modal"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" data-id="'.$link->id.'" class="grid-row-delete">
                                <i class="fa fa-trash"></i>
                            </a>';
                $html .= '</td>';
                $html .= '</tr>';
                $html .= $this->getLinks($link->id, $slas . '---');
            }
        }
        return $html;
    }

    public static function listOptionsSelected($category_id, $parent=0, $slas='')
    {
        $menus = Category::where('parent', $parent)->orderBy('sort','ASC')->get();
        $html = '';
        if($menus){
            foreach ($menus as $menu){
                $menuSelected = Category::where('id',$category_id)->first(['parent']);
                $selected = ( $menu->id == $menuSelected->parent ) ? 'selected= "selected"' : '';
                $html .= '<option value="'.$menu->id.'"'.$selected.'>'.$slas.$menu->name.'</option>';
                $html .= Category::listOptionsSelected($category_id, $menu->id, $slas . '---');
            }
        }
        return $html;
    }

    public static function getListMenuByGroup($parent=0, $slas='')
    {
        $cats = Category::where('parent', $parent)->orderBy('sort','ASC')->get();
        $html  = '';
        if($cats)
        {
            foreach($cats as $cat)
            {
                $html .= '<option value="'.$cat->id.'">'. $slas . ' ' .$cat->name.'</option>';
                $html .= self::getListMenuByGroup($cat->id, $slas.'---');
            }
        }
        return $html;
    }

    public function arrId($id)
    {
        $cats = PostCategory::getCatsByPostId($id);
        $arrId = [];
        foreach($cats as $key => $cat){
            $arrId[$key] = $cat->id;
        }
        return $arrId;
    }

    public function getListMenuByGroupSelected($post_id,$parent=0, $slas='')
    {
        $cats = Category::where('parent', $parent)->orderBy('sort','ASC')->get();
        $html  = '';
        if($cats)
        {
            foreach($cats as $cat)
            {
                $selected = ( in_array($cat->id, $this->arrId($post_id)) ) ? 'selected= "selected"' : '';
                $html .= '<option value="'.$cat->id.'"'.$selected.'>'. $slas . ' ' .$cat->name.'</option>';
                $html .= self::getListMenuByGroupSelected($post_id, $cat->id, $slas.'---');
            }
        }
        return $html;
    }

    public function getItem($id)
    {   
        $menu = Category::where('id',$id)->first();
        if($menu){
            return $menu;
        }
        return '';
    }

    public function getItemByParent($parent)
    {   
        $menu = Category::where('id',$parent)->first();
        if($menu){
            return $menu;
        }
        
        return '';
    }

    public static function getItemByUrl($slug)
    {   
        $menu = Category::where('slug', $slug)->first();
        if($menu){
            return $menu;
        }
        return '';
    }

    public function updateStatus($id)
    {
        $menuGroup = $this->getItem($id);
        $status = ($menuGroup->status === 1) ? 0 : 1;
        $update = $this->where('id',$id)->update([ 'status' => $status ]);
        $msg = ($update) ? config('admin.update_succeeded') : config('admin.failed');
        return $msg;
    }



    ########################H===Homes===###########################
    
    public static function getCategories()
    {
        $categories = Category::where('status',1)->where('parent',0)->orderBy('sort','asc')->get();
        return $categories;
    }
}

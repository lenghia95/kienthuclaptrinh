<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
// use App\Models\Language;

class Menulist extends Model
{
    
	
	protected $table = 'menulists';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];


    /*============================== Admin ================================= */
    public function getLinks($group, $parent = 0, $slas = '') {
        $html = '';
        $links = Menulist::where('parent', $parent)->where('menugroup', $group)->orderBy('sort', 'ASC')->get();
        if ($links) {
            foreach ($links as $link) {
                $html .= '<tr>';
                $html .= '<td>
                             <input type="checkbox" class="minimal">
                        </td>';
                $html .= '<td>' . $link->id . '</td>';
                $html .= '<td>' . $slas . ' ' . $link->name . '</td>';
                $html .= '<td>' . $link->url . '</td>';
                $html .= '<td align="center"><input type="checkbox"'. ( ($link->status === 1) ? 'checked' : '' ) .' data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="grid-switch-status" data-key="'.$link->id.'" value="'.( ($link->status === 1) ? 1 : 0 ) .'"></td>';
                $html .= '<td align="center">';
                $html .= '<a href="'.route('menulists.edit',['id'=>$link->id]).'" data-toggle="modal"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" data-id="'.$link->id.'" class="grid-row-delete">
                                <i class="fa fa-trash"></i>
                            </a>';
                $html .= '</td>';
                $html .= '</tr>';
                $html .= $this->getLinks($group, $link->id, $slas . '&nbsp;&nbsp;&nbsp;-');
            }
        }
        return $html;
    }

    public function listParentDefault($default = 0, $group = 0, $parent = 0, $slas = '') {
        $html = '';
        $lists = Menulist::where('parent', $parent)->where('menugroup', $group)->orderBy('sort', 'ASC')->get();
        if ($lists) {
            foreach ($lists as $list) {
                $selected = ($default == $list->id) ? 'selected="selected"' : '';
                $html .= "<option value='" . $list->id . "' " . $selected . ">" . $slas . ' ' . $list->name . "</option>";
                if ($default == $list->id) {
                    continue;
                }
                $html .= $this->listParentDefault($default, $group, $list->id, $slas . '&nbsp;&nbsp;&nbsp;-');
            }
        }

        return $html;
    }

    public static function getListMenuByGroup($groupKey, $parent=0, $slas='')
    {
        $menus = Menulist::where('menugroup',$groupKey)->where('parent', $parent)->orderBy('sort','ASC')->get();
        $html  = '';
        if($menus)
        {
            foreach($menus as $menu)
            {
                $html .= '<option value="'.$menu->id.'">'. $slas . ' ' .$menu->name.'</option>';
                $html .= self::getListMenuByGroup($groupKey, $menu->id, $slas.'&nbsp;&nbsp;&nbsp;-');
            }
        }
        return $html;
    }

    public function getItem($id)
    {   
        $menu = MenuList::where('id',$id)->first();
        if($menu){
            return $menu;
        }
        return '';
    }

    public function getItemByUrl($url)
    {   
        $menu = Menulist::where('url', $url)->first();
        if($menu){
            return $menu;
        }
        return '';
    }

    public function delItem($id)
    {   
        $del = MenuList::where('id',$id)->delete();
        $msg = ($del) ? config('admin.delete_succeeded') : config('admin.failed');
        return $msg;
    }
    
    public function updateStatus($id)
    {
        $menuGroup = $this->getItem($id);
        $status = ($menuGroup->status === 1) ? 0 : 1;
        $update = $this->where('id',$id)->update([ 'status' => $status ]);
        $msg = ($update) ? config('admin.update_succeeded') : config('admin.failed');
        return $msg;
    }


    #==================================HOME===============================#
    public static function getMenusList($group)
    {
        $group = Menugroup::where('key',$group)->first();
        $menus = Menulist::where('menugroup',$group->id)->orderBy('sort','ASC')->get();
        return $menus;
    }
}

<?php

namespace App\Helpers;


class InputRender
{

    public static function make($type, $name, $value , $option = []){
        switch ($type){
            case 'text':
                $html = self::inputText($name, $value, $option);
                break;
            case 'select':
                $html = self::inputSelect($name, $value, $option);
                break;
            case 'file':
                $html = self::inputFile($name, $value, $option);
                break;
            case 'textarea':
                $html = self::inputTextarea($name, $value, $option);
                break;

            default:
                $html = '';
                break;
        }

        return $html;
    }

    public static function inputFile($name, $value, $option){
        $html =' <div class="custom-file">
                    <input type="file" class="custom-file-input"  id="customFile" name="'.$name.'">
                    <label class="custom-file-label" for="customFile">'.$option['default'].'</label>
                </div>';
        return $html;
    }
    public static function inputSelect($name, $value, $option){
        $optionhtml = '';
        foreach ($option as $k=>$vl)
        {
            $optionhtml .= $k.'="'.$vl.'"';
        }
        $html = '<select name="'.$name.'" '.$optionhtml.'>';
        foreach ($value as $k => $vl )
        {
            $selected = ( isset($option['default']) &&  $option['default'] == $k ) ? 'selected="selected"' : '';
            $html .= '<option value="'.$k.'" '.$selected.'>'.$vl.'</option>';
        }
        $html .= '</select>';
        return $html;
    }

    public static function inputText($name, $value, $option){
        $optionhtml = '';
        foreach ($option as $k=>$vl)
        {
            $optionhtml .= $k.'="'.$vl.'"';
        }
        return '<input type="text" name="'.$name.'" value="'.$option['default'].'" '.$optionhtml.' />';
    }

    public static function inputTextarea($name, $value, $option){
        $optionhtml = '';
        foreach ($option as $k=>$vl)
        {
            $optionhtml .= $k.'="'.$vl.'"';
        }
        return '<textarea name="'.$name.'" '.$optionhtml.'>'.$option['default'].'</textarea>';

    }
}
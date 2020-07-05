<?php
class Module_2
{
    static function getHtml($array, $slug, $title = '')
    {
        for($i=0; $i<count($array); $i++) $array[$i]['slug'] = $slug;
        $strBefore = "<div class='container_module_2' data-slug='{$slug}' >";
		if($title !== '') $strBefore .= "<div class='title_module_2'>{$title}</div>";
		$strBefore .= "<div class='wrapper_module_2'>";
        $strAfter = "</div>
                        <div class='button_wrapper_module_2'>
                            <span class='add_module_2'>Добавить</span>
                        </div>
                    </div>";
        function createRow($item)
        {
            $strCod = "<div class='row_module_2'>
                        <div class='item_module_2'>
                            <input type='text' name='text_1_module_2_{$item['slug']}[]' value='{$item['text_1']}'>
                        </div>
                        <div class='item_module_2'>
                            <input type='text' name='text_2_module_2_{$item['slug']}[]' value='{$item['text_2']}'>
                        </div>
                        <span class='delete_module_2'>X</span>
                        <span class='up_module_2'>&#8657;</span>
                        <span class='bottom_module_2'>&#8659;</span>
                    </div>";

            return $strCod;
        }
        return $strBefore . implode('', array_map('createRow', $array)) . $strAfter;
    }
    static function getData($slug)
    { 
        $result = [];
        if (array_key_exists('text_1_module_2_'.$slug, $_POST)) {
            for($i=0; $i<count($_POST['text_1_module_2_'.$slug]); $i++) {
                $support['text_1'] = str_replace("'", '&#8242;', $_POST['text_1_module_2_'.$slug][$i]);
                $support['text_2'] = str_replace("'", '&#8242;', $_POST['text_2_module_2_'.$slug][$i]);
                $result[] = $support;
            }
        }
        return $result;
    }
}

<?php
class Module_1
{
    const PATH_UPLOADS = "template/uploads/";
    static function getHtml($array)
    {
        $strBefore = "<div class='container_module_1'><div class='wrapper_module_1'>";
        $strAfter = "</div>
                        <div class='button_wrapper_module_1'>
                            <span class='add_module_1'>Добавить</span>
                        </div>
                    </div>";
        function createRow($item)
        {
            $strCod = "<div class='row_module_1'>
                        <div class='item_module_1'>";
            if ($item['src'] !== "") $strCod .= "<img src='{$item['src']}'>";
            $strCod .= "<input type='file' name='img_module_1[]' value='{$item['src']}'>
                            <input type='hidden' name='old_img_module_1[]' value='{$item['src']}'>
                        </div>
                        <div class='item_module_1'>
                            <input type='text' name='text_1_module_1[]' value='{$item['text_1']}'>
                        </div>
                        <div class='item_module_1'>
                            <input type='text' name='text_2_module_1[]' value='{$item['text_2']}'>
                        </div>
                        <span class='delete_module_1'>X</span>
                        <span class='up_module_1'>&#8657;</span>
                        <span class='bottom_module_1'>&#8659;</span>
                    </div>";

            return $strCod;
        }
        return $strBefore . implode('', array_map('createRow', $array)) . $strAfter;
    }
    static function getData()
    {
        $result = [];
        if (array_key_exists('img_module_1', $_FILES)) {
            for ($i = 0; $i < count($_FILES["img_module_1"]['name']); $i++) {

                $file_tmp = $_FILES['img_module_1']['tmp_name'][$i];
                if ($_FILES['img_module_1']['name'][$i] === '') $file_name = $_POST['old_img_module_1'][$i];
                else $file_name = self::PATH_UPLOADS . time() . $_FILES['img_module_1']['name'][$i];
                $expensions = array('jpeg', "jpg", "png");
                if ($_FILES['img_module_1']['name'][$i] !== '') move_uploaded_file($file_tmp, $file_name);

                if ($_FILES['img_module_1']['name'][$i] === '' and $_POST['old_img_module_1'][$i] === '') $support['src'] = "";
                elseif ($_FILES['img_module_1']['name'][$i] === '' and $_POST['old_img_module_1'][$i] !== '') $support['src'] =  $file_name;
                else $support['src'] = "/" . $file_name;

                $support['text_1'] = $_POST['text_1_module_1'][$i];
                $support['text_2'] = $_POST['text_2_module_1'][$i];
                $result[] = $support;
            }
        }
        return $result;
    }
}

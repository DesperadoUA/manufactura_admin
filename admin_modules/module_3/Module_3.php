<?php
class Module_3
{
	const PATH_UPLOADS = "template/uploads/";
	static function getHtml($array, $slug)
	{
		for($i=0; $i<count($array); $i++) $array[$i]['slug'] = $slug;
		$strBefore = "<div class='container_module_3' data-slug='{$slug}' ><div class='wrapper_module_3'>";
		$strAfter = "</div>
                        <div class='button_wrapper_module_3'>
                            <span class='add_module_3'>Добавить</span>
                        </div>
                    </div>";
		function createRow($item)
		{
			$strCod = "<div class='row_module_3'>
                        <div class='item_module_3'>";

			   if ($item['src'] !== "") $strCod .= "<img src='{$item['src']}'>";
			   $strCod .= "<input type='file' name='img_module_3_{$item['slug']}[]' 
			                  value='{$item['src']}'>
						   <input type='hidden' name='old_img_module_3_{$item['slug']}[]' 
						   value='{$item['src']}'>
                        </div>
                        <div class='item_module_3'>
                            <input type='text' name='text_1_module_3_{$item['slug']}[]' value='{$item['text_1']}'>
                        </div>
                        <span class='delete_module_3'>X</span>
                        <span class='up_module_3'>&#8657;</span>
                        <span class='bottom_module_3'>&#8659;</span>
                    </div>";

			return $strCod;
		}
		return $strBefore . implode('', array_map('createRow', $array)) . $strAfter;
	}
	static function getData($slug)
	{
		$result = [];
		if (array_key_exists('img_module_3_'.$slug, $_FILES)) {
			for ($i = 0; $i < count($_FILES["img_module_3_".$slug]['name']); $i++) {

				$file_tmp = $_FILES['img_module_3_'.$slug]['tmp_name'][$i];
				if ($_FILES['img_module_3_'.$slug]['name'][$i] === '') $file_name = $_POST['old_img_module_3_'.$slug][$i];
				else $file_name = self::PATH_UPLOADS . time() . $_FILES['img_module_3_'.$slug]['name'][$i];
				$expensions = array('jpeg', "jpg", "png");
				if ($_FILES['img_module_3_'.$slug]['name'][$i] !== '') move_uploaded_file($file_tmp, $file_name);

				if ($_FILES['img_module_3_'.$slug]['name'][$i] === '' and $_POST['old_img_module_3_'.$slug][$i] === '') {
					$support['src'] = "";
				}
				elseif ($_FILES['img_module_3_'.$slug]['name'][$i] === '' and $_POST['old_img_module_3_'.$slug][$i] !== ''){
					$support['src'] =  $file_name;
				}
				else $support['src'] = "/" . $file_name;

				$support['text_1'] = $_POST['text_1_module_3_'.$slug][$i];
				$result[] = $support;
			}
		}
		return $result;
	}
}

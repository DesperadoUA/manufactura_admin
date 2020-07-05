<?php
class Module_6
{
	const PATH_UPLOADS = "template/uploads/";
	static function getHtml($src, $slug, $title = "Default")
	{
		$strCod = "<div class='container_module_6'>
                      <div class='wrapper_module_6'>
						  <div class='row_module_6'>
							<div class='item_module_6'>
								<input type='text'  value='{$title}' readonly>
							</div>
							<div class='item_module_6'>
								<input type='file' name='module_6_img_{$slug}' value='{$src}'>
								<input type='hidden' name='module_6_old_img_{$slug}' value='{$src}'>
							</div>
							<div class='item_module_6'>";
		if ($src !== "") $strCod .= "<img src='{$src}'>";
		$strCod .=	"</div>
						  </div>
					  </div>
				   </div>";
		return $strCod;
	}
	static function getData($slug)
	{
		if ($_FILES['module_6_img_'.$slug]['name']) {
			$file_tmp = $_FILES['module_6_img_'.$slug]['tmp_name'];
			$file_name = self::PATH_UPLOADS . time() . $_FILES['module_6_img_'.$slug]['name'];
			move_uploaded_file($file_tmp, $file_name);
			$result = "/".$file_name;
		} else {
			$result = $_POST['module_6_old_img_'.$slug];
		}
		return $result;
	}
}

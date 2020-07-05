<?php
class Module_5
{
	static function getHtml($strLink, $slug, $title = "Default")
	{
		$strCod = "<div class='container_module_5'>
                      <div class='wrapper_module_5'>
						  <div class='row_module_5'>
							<div class='item_module_5'>
								<input type='text'  value='{$title}' readonly>
							</div>
							<div class='item_module_5'>
								<input type='text' name='module_5_text_1_{$slug}' value='{$strLink}'>
							</div>
						  </div>
					  </div>
				   </div>";
		return $strCod;
	}
	static function getData($slug)
	{
		$result = $_POST['module_5_text_1_'.$slug];
		return $result;
	}
}

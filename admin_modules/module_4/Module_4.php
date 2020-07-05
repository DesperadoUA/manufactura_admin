<?php
class Module_4
{
	static function getHtml($array)
	{
		$strCod = "<div class='container_module_4'><div class='wrapper_module_4'>
                    
                      <div class='row_module_4'>
                        <div class='item_module_4'>
                        	<input type='text' name='appointment' value='Записаться на прием' readonly>
						</div>
						<div class='item_module_4'>
                        	<input type='text' name='appointment_mails' 
                        	value='";
		if(array_key_exists('appointment', $array)) $strCod .= $array['appointment'];

		$strCod .= "' placeholder='Почты через запятую'>
						</div>
                      </div>
                      
                      <div class='row_module_4'>
                        <div class='item_module_4'>
                        	<input type='text' name='queshen' value='Задать вопрос' readonly>
						</div>
						<div class='item_module_4'>
                        	<input type='text' name='queshen_mails'
                        	 value='";

		if(array_key_exists('queshen', $array)) $strCod .= $array['queshen'];

		$strCod .= "' placeholder='Почты через запятую' >
						</div>
                      </div>
                      
                      <div class='row_module_4'>
                        <div class='item_module_4'>
                        	<input type='text' name='main' value='Главная форма' readonly>
						</div>
						<div class='item_module_4'>
                        	<input type='text' name='main_mails' 
                        	value='";

		if(array_key_exists('main', $array)) $strCod .= $array['main'];

		$strCod .= "'  placeholder='Почты через запятую' >
						</div>
                      </div>
                      
                      <div class='row_module_4'>
                        <div class='item_module_4'>
                        	<input type='text' name='reviews' value='Отзывы' readonly>
						</div>
						<div class='item_module_4'>
                        	<input type='text' name='reviews_mails' 
                        	value='";

		if(array_key_exists('reviews', $array)) $strCod .= $array['reviews'];

         $strCod .= "' placeholder='Почты через запятую' >
						</div>
                      </div>
                      
                      <div class='row_module_4'>
                        <div class='item_module_4'>
                        	<input type='text' name='job' value='Вакансии' readonly>
						</div>
						<div class='item_module_4'>
                        	<input type='text' name='job_mails' 
                        	value='";

		if(array_key_exists('job', $array)) $strCod .= $array['job'];

         $strCod .= "' placeholder='Почты через запятую'>
						</div>
                      </div>
                      
                    </div></div>";

		return $strCod;
	}
	static function getData()
	{
		$result = [];
		$result['appointment'] = $_POST['appointment_mails'];
		$result['queshen'] = $_POST['queshen_mails'];
		$result['main'] = $_POST['main_mails'];
		$result['reviews'] = $_POST['reviews_mails'];
		$result['job'] = $_POST['job_mails'];
		return $result;
	}
}

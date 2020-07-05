<?php
if(!array_key_exists('logos', $data["json_content"])) $data["json_content"]['logos'] = [];
echo Module_3::getHtml($data["json_content"]['logos'], 'logos');
?>
<?php
if(!array_key_exists('emails', $data["json_content"])) $data["json_content"]['emails'] = [];
echo Module_4::getHtml($data["json_content"]['emails']);
<?php
if(!array_key_exists('redirects', $data["json_content"])) $data["json_content"]['redirects'] = [];
echo Module_2::getHtml($data["json_content"]['redirects'], 'redirects', 'Настройка редиректов');
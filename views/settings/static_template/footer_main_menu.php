    <?php 
        if(!array_key_exists('menu', $data["json_content"])) $data["json_content"]['menu'] = [];
        echo Module_2::getHtml($data["json_content"]['menu'], 'menu', 'Редактирование меню');
    ?>
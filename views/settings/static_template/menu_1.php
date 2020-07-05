<div class="container_menu">
    <?php
    if (array_key_exists('menu_anchor', $data['json_content'])) {
        for ($i = 0; $i < count($data['json_content']['menu_anchor']); $i++) {
            echo '<div class="row">
            <div class="col-lg-5">
                <input class="admin_input" placeholder="Тектс" type="text" name="menu_anchor[]" value="' . $data['json_content']['menu_anchor'][$i] . '" >
            </div>
            <div class="col-lg-5">
                <input class="admin_input" placeholder="Link" type="text" name="menu_link[]" value="' . $data['json_content']['menu_link'][$i] . '">
            </div>
            <div class="col-lg-2 text-center">
                <a href="#" class="neon_button_red delete_menu_item">Удалить<span></span><span></span><span></span><span></span></a>
            </div>
        </div>';
        }
    }
    ?>
</div>
<div class="container_button text_center">
    <span class="btn_mm add_item_menu">Добавить</span>
</div>
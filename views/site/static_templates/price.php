<div class="container_menu">
    <?php
    for ($i = 0; $i < count($data['json_content']); $i++) {
        echo '<div class="row wrapper_item_menu">
                    <div class="col-lg-5">
                       <input class="admin_input main_menu_anchor" placeholder="Тектс" type="text" value="' . $data['json_content'][$i]['menuAnchor'] . '">
                    </div>
                    <div class="col-lg-5">
                       <input class="admin_input main_menu_link" placeholder="Link" type="text" value="' . $data['json_content'][$i]['menuLink'] . '">
                    </div>
                    <div class="col-lg-2 text-center">
                       <a href="#" class="neon_button_red delete_menu_item_2">Удалить<span></span><span></span><span></span><span></span></a>
                    </div>
                    <div class="col-lg-12 dropdown_menu_container">
                        <div class="container_wrapper_dropdown">';
        for ($j = 0; $j < count($data['json_content'][$i]['menuChildren']); $j++) {
            echo '<div class="row"><div class="col-lg-5"><input class="admin_input  dropdown_menu_anchor" placeholder="Тектс" type="text" value="' . $data['json_content'][$i]['menuChildren'][$j]["menuAnchor"] . '">
                     </div><div class="col-lg-5">
                       <input class="admin_input dropdown_menu_link" placeholder="Link" type="text" value="' . $data['json_content'][$i]['menuChildren'][$j]["menuLink"] . '">
                     </div><div class="col-lg-2 text-center">
                  <a href="#" class="neon_button_red delete_menu_item">Удалить<span></span><span></span><span></span><span></span></a></div></div>';
        }

        echo  '</div>
                    <div class="col-lg-12 text-right">
                        <a href="#" class="add_dropdown_item neon_button_red">Добавить<span></span><span></span><span></span><span></span></a>
                    </div>
                </div>
               </div>';
    }
    ?>
</div>
<div class="container_button text_center">
    <span class="btn_mm add_item_menu_2">Добавить</span> <span class="btn_mm save_price">Сохранить</span> <span class="result_save"></span>
</div>
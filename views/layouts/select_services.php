<div class="row">
    <div class="col-lg-12">
        <div class="lang_link_title">Выберите услугу</div>
        <div class="wrapper_direction_link">
            <?php
            if (count($data_services) != 0) {
                for ($i = 0; $i < count($data_services['post_title']); $i++) {
                    echo "<div class='box_lang_link'>
                    <input type='checkbox' id='services_" . $i . "' name='services[]' class='select_services' ";
                    if (is_array($data['services_id'])) {
                        if (in_array($data_services['id'][$i], $data['services_id'])) {
                            echo "checked";
                        }
                    }
                    echo " value='" . $data_services['id'][$i] . "'>
                    <label for='services_" . $i . "'>" . $data_services['post_title'][$i] . "</label>
                </div>";
                }
            }
            ?>
        </div>
    </div>
    <div class="lang_wrapper_button">
        <a href="#" class="neon_button_red" id="clear_services"><span></span><span></span><span></span><span></span>Без услуг</a>
    </div>
</div>
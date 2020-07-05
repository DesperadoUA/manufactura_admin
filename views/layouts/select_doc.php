<div class="row">
    <div class="col-lg-12">
        <div class="lang_link_title">Выберите врача</div>
        <div class="wrapper_direction_link">
            <?php
            if (count($data_staff) != 0) {
                for ($i = 0; $i < count($data_staff['post_title']); $i++) {
                    echo "<div class='box_lang_link'>
                        <input type='checkbox' id='staff_" . $i . "' name='staff[]' class='select_staff' ";
                    if ($data_staff['id'][$i] == $data['staff_id']) {
                        echo "checked";
                    }
                    echo " value='" . $data_staff['id'][$i] . "'>
                        <label for='staff_" . $i . "'>" . $data_staff['post_title'][$i] . "</label>
                    </div>";
                }
            }
            ?>
        </div>
    </div>
    <div class="lang_wrapper_button">
        <a href="#" class="neon_button_red" id="clear_doc"><span></span><span></span><span></span><span></span>Без врача</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="lang_link_title">Выберите Направления</div>
        <div class="wrapper_direction_link">
            <?php
            if (count($data_direction) != 0) {
                for ($i = 0; $i < count($data_direction['post_title']); $i++) {
                    echo "<div class='box_lang_link'>
                    <input type='checkbox' id='direction_" . $i . "' name='direction[]' class='select_direction_multiple' ";
                    if (is_array($data['direction_id'])) {
                        if (in_array($data_direction['id'][$i], $data['direction_id'])) {
                            echo "checked";
                        }
                    }
                    echo " value='" . $data_direction['id'][$i] . "'>
                    <label for='direction_" . $i . "'>" . $data_direction['post_title'][$i] . "</label>
                </div>";
                }
            }
            ?>
        </div>
    </div>
</div>
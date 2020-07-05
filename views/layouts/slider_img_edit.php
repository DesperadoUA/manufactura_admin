<div class="row">
    <div class="col-lg-12 slider_wrapper">
        <?php
        if (array_key_exists('slider_img', $data['json_content'])) {
            if ($data['json_content']['slider_img'] != 0) {
                for ($i = 0; $i < count($data['json_content']['slider_img']); $i++) {
                    echo "<div class='slider_item'><input type='file' name='slider_img[]'><input type='text' name='defolt_slider_img[]' value='" . $data['json_content']['slider_img'][$i] . "' class='hide'/><div class='img_box'><img src='" . $data['json_content']['slider_img'][$i] . "'></div><input type='button' class='delete_slide red_btn_mm' value='Удалить'/></div>";
                }
            }
        }
        ?>
    </div>
    <div class="col-lg-12 text-right">
        <input type="button" value="Добавить слайд" id="add_slide" class="btn_mm">
    </div>
</div>
<div class="row">
    <div class="col-lg-1">Основное содержимое</div>
    <div class="col-lg-11">
        <textarea name="main_content" class="summernote"><?= $data['json_content']['main_content']; ?></textarea>
    </div>
</div>
<div class="row">
    <div class="col-lg-1">Текст под H1</div>
    <div class="col-lg-11">
        <textarea name="h1_desc" class="summernote"><?= $data['json_content']['h1_desc']; ?></textarea>
    </div>
</div>
<div class="row">
    <div class="col-lg-1">Общее название блоков</div>
    <div class="col-lg-5">
        <input name="title_service_global" class="admin_input" value="<?php
                                                                        if (array_key_exists('title_service_global', $data['json_content'])) {
                                                                            echo  $data['json_content']['title_service_global'];
                                                                        }
                                                                        ?>">
    </div>
</div>
<div class="row">
    <div class="col-lg-1">Название услуги 1</div>
    <div class="col-lg-5">
        <input name="title_service_1" class="admin_input" value="<?= $data['json_content']['title_service_1']; ?>">
    </div>
    <div class="col-lg-1">Название услуги 2</div>
    <div class="col-lg-5">
        <input name="title_service_2" class="admin_input" value="<?= $data['json_content']['title_service_2']; ?>">
    </div>
    <div class="col-lg-1">Название услуги 3</div>
    <div class="col-lg-5">
        <input name="title_service_3" class="admin_input" value="<?= $data['json_content']['title_service_3']; ?>">
    </div>
    <div class="col-lg-1">Название услуги 4</div>
    <div class="col-lg-5">
        <input name="title_service_4" class="admin_input" value="<?= $data['json_content']['title_service_4']; ?>">
    </div>
</div>
<div class="row">
    <div class="col-lg-1">Название кнопки 1</div>
    <div class="col-lg-5">
        <input name="title_button_1" class="admin_input" value="<?php
                                                                if (array_key_exists('title_button_1', $data['json_content'])) {
                                                                    echo  $data['json_content']['title_button_1'];
                                                                }
                                                                ?>">
    </div>
    <div class="col-lg-1">Ссылка кнопки 1</div>
    <div class="col-lg-5">
        <input name="link_button_1" class="admin_input" value="<?php
                                                                if (array_key_exists('link_button_1', $data['json_content'])) {
                                                                    echo  $data['json_content']['link_button_1'];
                                                                }
                                                                ?>">
    </div>
    <div class="col-lg-1">Название кнопки 2</div>
    <div class="col-lg-5">
        <input name="title_button_2" class="admin_input" value="<?php
                                                                if (array_key_exists('title_button_2', $data['json_content'])) {
                                                                    echo  $data['json_content']['title_button_2'];
                                                                }
                                                                ?>">
    </div>
    <div class="col-lg-1">Ссылка кнопки 2</div>
    <div class="col-lg-5">
        <input name="link_button_2" class="admin_input" value="<?php
                                                                if (array_key_exists('link_button_2', $data['json_content'])) {
                                                                    echo  $data['json_content']['link_button_2'];
                                                                }
                                                                ?>">
    </div>
    <div class="col-lg-1">Название кнопки 3</div>
    <div class="col-lg-5">
        <input name="title_button_3" class="admin_input" value="<?php
                                                                if (array_key_exists('title_button_3', $data['json_content'])) {
                                                                    echo  $data['json_content']['title_button_3'];
                                                                }
                                                                ?>">
    </div>
    <div class="col-lg-1">Ссылка кнопки 3</div>
    <div class="col-lg-5">
        <input name="link_button_3" class="admin_input" value="<?php
                                                                if (array_key_exists('link_button_3', $data['json_content'])) {
                                                                    echo  $data['json_content']['link_button_3'];
                                                                }
                                                                ?>">
    </div>
    <div class="col-lg-1">Название кнопки 4</div>
    <div class="col-lg-5">
        <input name="title_button_4" class="admin_input" value="<?php
                                                                if (array_key_exists('title_button_4', $data['json_content'])) {
                                                                    echo  $data['json_content']['title_button_4'];
                                                                }
                                                                ?>">
    </div>
    <div class="col-lg-1">Ссылка кнопки 4</div>
    <div class="col-lg-5">
        <input name="link_button_4" class="admin_input" value="<?php
                                                                if (array_key_exists('link_button_4', $data['json_content'])) {
                                                                    echo  $data['json_content']['link_button_4'];
                                                                }
                                                                ?>">
    </div>

</div>
<div class="row">
    <div class="col-lg-1">Описание услуги 1</div>
    <div class="col-lg-11">
        <textarea name="desc_service_1" class="summernote"><?= $data['json_content']['desc_service_1']; ?></textarea>
    </div>
</div>
<div class="row">
    <div class="col-lg-1">Описание услуги 2</div>
    <div class="col-lg-11">
        <textarea name="desc_service_2" class="summernote"><?= $data['json_content']['desc_service_2']; ?></textarea>
    </div>
</div>
<div class="row">
    <div class="col-lg-1">Описание услуги 3</div>
    <div class="col-lg-11">
        <textarea name="desc_service_3" class="summernote"><?= $data['json_content']['desc_service_3']; ?></textarea>
    </div>
</div>
<div class="row">
    <div class="col-lg-1">Описание услуги 4</div>
    <div class="col-lg-11">
        <textarea name="desc_service_4" class="summernote"><?= $data['json_content']['desc_service_4']; ?></textarea>
    </div>
</div>
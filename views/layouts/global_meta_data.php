    <form method="post" action="" enctype="multipart/form-data" class="admin_form template_edit">
        <div class="row">
            <div class="col-lg-1">Название статьи</div>
            <div class="col-lg-5">
                <input type="text" name="post_title" class="admin_input post_title" value="<?php echo $data['post_title']; ?>" />
            </div>
            <div class="col-lg-1">Permalink</div>
            <div class="col-lg-5">
                <input type="text" name="permalink" class="admin_input" id="permalink" value="<?php echo $data['permalink']; ?>" />
            </div>
        </div>
        <div class="row title_row">
            <div class="col-lg-1">Title</div>
            <div class="col-lg-5">
                <input type="text" name="title" class="admin_input" value="<?php echo $data['title']; ?>" />
            </div>
            <div class="col-lg-1">Description</div>
            <div class="col-lg-5">
                <input type="text" name="description" class="admin_input" value="<?php echo $data['description']; ?>" />
            </div>
        </div>
        <div class="row keywords_row">
            <div class="col-lg-1">Keywords</div>
            <div class="col-lg-5">
                <input type="text" name="keywords" class="admin_input" value="<?php echo $data['keywords']; ?>" />
            </div>
            <div class="col-lg-1">Статус</div>
            <div class="col-lg-5">
                <select class="admin_select" name="status">
                    <option value="<?php if ($data['status'] == 1) {
                                        echo "1";
                                    } else {
                                        echo "0";
                                    } ?>">
                        <?php
                        if ($data['status'] == 1) {
                            echo "Опубликована";
                        } else {
                            echo "Не опубликовано";
                        }
                        ?>
                    </option>
                    <option value="<?php if ($data['status'] == 1) {
                                        echo "0";
                                    } else {
                                        echo "1";
                                    } ?>">
                        <?php
                        if ($data['status'] == 1) {
                            echo "Не опубликовано";
                        } else {
                            echo "Опубликована";
                        }
                        ?>
                    </option>
                </select>
            </div>
            <div class="col-lg-1 hide">Выбор языка</div>
            <div class="col-lg-5">
                <select class="admin_select hide" name="lang" id="lang_select">
                    <option>
                        <?php
                        if ($data['lang'] == 1) {
                            echo "Ru";
                        }
                        if ($data['lang'] == 2) {
                            echo "En";
                        }
                        if ($data['lang'] == 3) {
                            echo "Ua";
                        }
                        ?>
                    </option>
                    <option>
                        <?php
                        if ($data['lang'] == 1) {
                            echo "En";
                        }
                        if ($data['lang'] == 2) {
                            echo "Ru";
                        }
                        if ($data['lang'] == 3) {
                            echo "Ru";
                        }
                        ?>
                    </option>
                    <option>
                        <?php
                        if ($data['lang'] == 1) {
                            echo "Ua";
                        }
                        if ($data['lang'] == 2) {
                            echo "Ua";
                        }
                        if ($data['lang'] == 3) {
                            echo "En";
                        }
                        ?>
                    </option>
                </select>
            </div>
        </div>
        <div class="row short_desc_row">
            <div class="col-lg-1">Короткое описание</div>
            <div class="col-lg-5">
                <textarea name="short_desc" class="summernote"><?php echo $data['short_desc']; ?></textarea>
            </div>
            <div class="col-lg-1">Дата публикации</div>
            <div class="col-lg-5">
                <input type="date" name="post_data" class="admin_input" required value="<?php echo $data['post_data']; ?>" />
            </div>
        </div>
        <div class="row prevyu_row">
            <div class="col-lg-1">Превью статьи 300x200</div>
            <div class="col-lg-5">
                <input type="file" name="img" id="post_prevyu" class="admin_input" />
                <input type="text" name="defolt_img" id="post_prevyu_show" class="hide" value="<?php echo $data['img']; ?>">
            </div>
            <div class="col-lg-6 block_img text-right">
                <?php
                if ($data['img'] != "0") {
                    echo "<img src='" . $data['img'] . "'>";
                }
                ?>
            </div>
        </div>
        <div class="row wrapper-translate">
            <div class="col-lg-6">
                <div class="lang_link_title">Выберите перевод</div>
                <div class="wrapper_lang_link">
                    <?php
                    if ($data['lang'] == 1) {
                        if ($data['en_id'] != 0) {
                            echo "<div class='box_lang_link'>
                                     <input type='checkbox' id='lang_1_defolt' name='lang_1[]' class='select_lang_1' checked value='" . $data['en_id'] . "'>
                                     <label for='lang_1_defolt'>" . $data['en_post_title'] . "</label></div>";
                        }
                    }
                    if ($data['lang'] == 2) {
                        if ($data['ru_id'] != 0) {
                            echo "<div class='box_lang_link'>
                                     <input type='checkbox' id='lang_1_defolt' name='lang_1[]' class='select_lang_1' checked value='" . $data['ru_id'] . "'>
                                     <label for='lang_1_defolt'>" . $data['ru_post_title'] . "</label></div>";
                        }
                    }
                    if ($data['lang'] == 3) {
                        if ($data['ru_id'] != 0) {
                            echo "<div class='box_lang_link'>
                                     <input type='checkbox' id='lang_1_defolt' name='lang_1[]' class='select_lang_1' checked value='" . $data['ru_id'] . "'>
                                     <label for='lang_1_defolt'>" . $data['ru_post_title'] . "</label></div>";
                        }
                    }

                    for ($i = 0; $i < count($data['lang_first']); $i++) {
                        echo "<div class='box_lang_link'>
                                     <input type='checkbox' id='lang_1_" . $i . "' name='lang_1[]' class='select_lang_1' value='" . $data['lang_first'][$i]['id'] . "'>
                                     <label for='lang_1_" . $i . "'>" . $data['lang_first'][$i]['post_title'] . "</label></div>";
                    }
                    ?>
                </div>
                <input type="text" name="defolt_lang_1" class="hide" value="<?php if ($data['lang'] == 1) {
                                                                                echo $data['en_id'];
                                                                            }
                                                                            if ($data['lang'] == 2) {
                                                                                echo $data['ru_id'];
                                                                            }
                                                                            if ($data['lang'] == 3) {
                                                                                echo $data['ru_id'];
                                                                            } ?>">
                <div class="lang_wrapper_button">
                    <a href="#" class="neon_button_red" id="clear_translate_1"><span></span><span></span><span></span><span></span>Без перевода</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="lang_link_title">Выберите перевод</div>
                <div class="wrapper_lang_link">
                    <?php

                    if ($data['lang'] == 1) {
                        if ($data['ua_id'] != 0) {
                            echo "<div class='box_lang_link'>
                                    <input type='checkbox' id='lang_2_defolt' name='lang_2[]' class='select_lang_2' checked value='" . $data['ua_id'] . "'>
                                    <label for='lang_2_defolt'>" . $data['ua_post_title'] . "</label></div>";
                        }
                    }
                    if ($data['lang'] == 2) {
                        if ($data['ua_id'] != 0) {
                            echo "<div class='box_lang_link'>
                                    <input type='checkbox' id='lang_2_defolt' name='lang_2[]' class='select_lang_2' checked value='" . $data['ua_id'] . "'>
                                    <label for='lang_2_defolt'>" . $data['ua_post_title'] . "</label></div>";
                        }
                    }
                    if ($data['lang'] == 3) {
                        if ($data['en_id'] != 0) {
                            echo "<div class='box_lang_link'>
                                    <input type='checkbox' id='lang_2_defolt' name='lang_2[]' class='select_lang_2' checked value='" . $data['en_id'] . "'>
                                    <label for='lang_2_defolt'>" . $data['en_post_title'] . "</label></div>";
                        }
                    }
                    for ($i = 0; $i < count($data['lang_second']); $i++) {
                        echo "<div class='box_lang_link'>
                                     <input type='checkbox' id='lang_2_" . $i . "' name='lang_2[]' class='select_lang_2' value='" . $data['lang_second'][$i]['id'] . "'>
                                     <label for='lang_2_" . $i . "'>" . $data['lang_second'][$i]['post_title'] . "</label></div>";
                    }
                    ?>
                </div>
                <input type="text" name="defolt_lang_2" class="hide" value="<?php if ($data['lang'] == 1) {
                                                                                echo $data['ua_id'];
                                                                            }
                                                                            if ($data['lang'] == 2) {
                                                                                echo $data['ua_id'];
                                                                            }
                                                                            if ($data['lang'] == 3) {
                                                                                echo $data['en_id'];
                                                                            }
                                                                            ?>">
                <div class="lang_wrapper_button">
                    <a href="#" class="neon_button_red" id="clear_translate_2"><span></span><span></span><span></span><span></span>Без перевода</a>
                </div>
            </div>
        </div>
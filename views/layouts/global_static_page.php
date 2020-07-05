<form method="post" action="" enctype="multipart/form-data" class="admin_form template_edit">
    <div class="row">
        <div class="col-lg-1">Название статьи</div>
        <div class="col-lg-5">
            <input type="text" name="post_title" class="admin_input" value="<?php echo $data['post_title']; ?>" />
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5">
            <input type="text" name="permalink" class="admin_input hide" id="permalink" value="<?php echo $data['permalink']; ?>" />
        </div>
    </div>
    <div class="row">
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

    </div>
    <div class="row short_desc_row">
        <div class="col-lg-1">Короткое описание</div>
        <div class="col-lg-11">
            <textarea name="short_desc" class="summernote"><?php echo $data['short_desc']; ?></textarea>
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
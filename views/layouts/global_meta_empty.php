    <form method="post" action="" enctype="multipart/form-data" class="admin_form template_add">
        <div class="row post_title_row">
            <div class="col-lg-1">Название статьи</div>
            <div class="col-lg-5">
                <input type="text" name="post_title" class="admin_input" id="post_title" required />
            </div>
            <div class="col-lg-1">Permalink</div>
            <div class="col-lg-5">
                <input type="text" name="permalink" class="admin_input" required readonly id="permalink" />
            </div>
        </div>
        <div class="row title_row">
            <div class="col-lg-1">Title</div>
            <div class="col-lg-5">
                <input type="text" name="title" class="admin_input" />
            </div>
            <div class="col-lg-1">Description</div>
            <div class="col-lg-5">
                <input type="text" name="description" class="admin_input" />
            </div>
        </div>
        <div class="row keywords_row">
            <div class="col-lg-1">Keywords</div>
            <div class="col-lg-5">
                <input type="text" name="keywords" class="admin_input" />
            </div>
        </div>
        <div class="row status_row">
            <div class="col-lg-1">Статус</div>
            <div class="col-lg-5">
                <select class="admin_select" name="status">
                    <option value="1">Опубликована</option>
                    <option value="0">Не опубликовано</option>
                </select>
            </div>
            <div class="col-lg-1">Выбор языка</div>
            <div class="col-lg-5">
                <select class="admin_select" name="lang" id="lang_select">
                    <option>Ua</option>
                    <option>Ru</option>
                    <option>En</option>
                </select>
            </div>
        </div>
        <div class="row short_desc_row">
            <div class="col-lg-1">Короткое описание</div>
            <div class="col-lg-11">
                <textarea name="short_desc" class="summernote"></textarea>
            </div>
        </div>
        <div class="row prevyu_row">
            <div class="col-lg-1">Превью статьи 300x200</div>
            <div class="col-lg-5">
                <input type="file" name="img" id="post_prevyu" class="admin_input" />
                <input type="text" name="defolt_img" id="post_prevyu_show" class="hide" value="/template/uploads/defolt.jpg">
            </div>
            <div class="col-lg-6 block_img text-right">
            </div>
        </div>
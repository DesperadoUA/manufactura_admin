<div class="row">
    <div class="col-lg-1">Текст под H1</div>
    <div class="col-lg-11">
        <textarea name="h1_desc" class="summernote"><?php if (array_key_exists('h1_desc', $data['json_content'])) echo $data['json_content']['h1_desc']; ?>
        </textarea>
    </div>
</div>
<div class="row">
    <div class="col-lg-1">Основное содержимое</div>
    <div class="col-lg-11">
        <textarea name="main_content" class="summernote"><?php if (array_key_exists('main_content', $data['json_content'])) echo $data['json_content']['main_content']; ?></textarea>
    </div>
</div>
<?php require_once(ROOT . "/views/layouts/slider_img_edit.php"); ?>
<div class="row">
    <div class="col-lg-1">Текст под баннером</div>
    <div class="col-lg-11">
        <textarea name="last_text" class="summernote"><?php if (array_key_exists('last_text', $data['json_content'])) echo $data['json_content']['last_text']; ?></textarea>
    </div>
</div>
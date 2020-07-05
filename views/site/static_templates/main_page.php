<div class="row">
    <div class="col-lg-1">Основной контент</div>
    <div class="col-lg-11">
        <textarea name="main_content" class="summernote"><?= $data['json_content']['main_content']; ?></textarea>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <h2>Плюсы клиники</h2>
    </div>
</div>
<?php
if (!array_key_exists('pluses', $data['json_content'])) $data['json_content']['pluses'] = [];
echo Module_1::getHtml($data['json_content']['pluses']);
?>
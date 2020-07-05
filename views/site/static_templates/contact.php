<div class="row">
    <div class="col-lg-1">Текст слева</div>
    <div class="col-lg-11">
        <textarea name="text_left" class="summernote"><?php echo $data['json_content']['text_left'];
                                                        ?></textarea>
    </div>
</div>
<div class="row">
    <div class="col-lg-1">Текст справа</div>
    <div class="col-lg-11">
        <textarea name="text_right" class="summernote"><?php echo $data['json_content']['text_right'];
                                                        ?></textarea>
    </div>
</div>
<div class="row">
    <div class="col-lg-1">Текст под картой</div>
    <div class="col-lg-11">
        <textarea name="main_content" class="summernote"><?php echo $data['json_content']['main_content'];
                                                            ?></textarea>
    </div>
</div>
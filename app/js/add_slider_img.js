
jQuery("#add_slide").click(function(){
    const STR_COD="<div class='slider_item'><input type='file' name='slider_img[]' required ><input type='button' class='delete_slide' value='Удалить'/></div>";
    jQuery(".slider_wrapper").append(STR_COD);
    jQuery(".delete_slide").click(function(){
        jQuery(this).parent().remove();
    })
})
jQuery(".delete_slide").click(function(){
    jQuery(this).parent().remove();
});
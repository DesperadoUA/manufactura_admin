function EditorMenu () {
    if(jQuery('.add_item_menu').length !== 0) {
        jQuery('.add_item_menu').click(function(){
            const strCod = '<div class="row"><div class="col-lg-5"><input class="admin_input" placeholder="Тектс" type="text" name="menu_anchor[]">'+
            '</div><div class="col-lg-5"><input class="admin_input" placeholder="Link" type="text" name="menu_link[]"></div><div class="col-lg-2 text-center">'+
            '<a href="#" class="neon_button_red delete_menu_item">Удалить<span></span><span></span><span></span><span></span></a></div></div>';
            jQuery('.container_menu').append(strCod);
            initMenuItemDelete();
        });
        initMenuItemDelete();
    }
    function initMenuItemDelete(){
        jQuery('.delete_menu_item').off('click');
        jQuery('.delete_menu_item').click(function() {
            event.preventDefault();
            jQuery(this).parent('.col-lg-2').parent('.row').remove();
        });
    }
}

EditorMenu();
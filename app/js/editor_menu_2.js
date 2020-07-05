function EditorMenuSecond () {
    if(jQuery('.add_item_menu_2').length !== 0) { 
        jQuery('.add_item_menu_2').click(function(){
            const strCod = '<div class="row wrapper_item_menu"><div class="col-lg-5"><input class="admin_input main_menu_anchor" placeholder="Тектс" type="text">'+
            '</div><div class="col-lg-5"><input class="admin_input main_menu_link" placeholder="Link" type="text"></div><div class="col-lg-2 text-center">'+
            '<a href="#" class="neon_button_red delete_menu_item_2">Удалить<span></span><span></span><span></span><span></span></a></div>'+
            '<div class="col-lg-12 dropdown_menu_container"><div class="container_wrapper_dropdown"></div><div class="col-lg-12 text-right"><a href="#" class="add_dropdown_item neon_button_red">Добавить<span></span><span></span><span></span><span></span></a></div></div>';
            jQuery('.container_menu').append(strCod);
            initMenuItemDelete();
            initMenuItemDropdownAdd();
        });
        initMenuItemDelete();
        initMenuItemDropdownAdd();
        initMenuItemDropdownDelete();
    }
    function initMenuItemDelete(){ 
        jQuery('.delete_menu_item_2').off('click');
        jQuery('.delete_menu_item_2').click(function() {
            event.preventDefault();
            jQuery(this).parent('.col-lg-2').parent('.row').remove();
        });
    }
    function initMenuItemDropdownAdd(){
        jQuery('.add_dropdown_item').off('click');
        jQuery('.add_dropdown_item').click(function() {
            const strCod = '<div class="row"><div class="col-lg-5"><input class="admin_input  dropdown_menu_anchor" placeholder="Тектс" type="text">'+
            '</div><div class="col-lg-5"><input class="admin_input dropdown_menu_link" placeholder="Link" type="text"></div><div class="col-lg-2 text-center">'+
            '<a href="#" class="neon_button_red delete_menu_item">Удалить<span></span><span></span><span></span><span></span></a></div></div>';
            event.preventDefault();
            jQuery(this).parent('.col-lg-12').prev('.container_wrapper_dropdown').append(strCod);
            initMenuItemDropdownDelete();
        });
    }
    function initMenuItemDropdownDelete(){
        jQuery('.delete_menu_item').off('click');
        jQuery('.delete_menu_item').click(function() {
            event.preventDefault();
            jQuery(this).parent('.col-lg-2').parent('.row').remove();
        });
    }
    jQuery('.save_menu').click(function(){
        let objectResult = [];
        for(i=0; i<jQuery(".wrapper_item_menu").length; i++) {
            let menuItem = {
                menuLink: '',
                menuAnchor: '',
                menuChildren: []
            }
            menuItem.menuLink = jQuery('.wrapper_item_menu').eq(i).find('.main_menu_link').val();
            menuItem.menuAnchor = jQuery('.wrapper_item_menu').eq(i).find('.main_menu_anchor').val();
            for(j=0; j<jQuery('.wrapper_item_menu').eq(i).find('.dropdown_menu_anchor').length; j++) {
                let childrenMenu = {
                    menuLink: '',
                    menuAnchor: '',
                }
                childrenMenu.menuLink = jQuery('.wrapper_item_menu').eq(i).find('.dropdown_menu_link').eq(j).val();
                childrenMenu.menuAnchor = jQuery('.wrapper_item_menu').eq(i).find('.dropdown_menu_anchor').eq(j).val();
                menuItem.menuChildren.push(childrenMenu)
            }
            objectResult.push(menuItem);
        }
        const Id = location.pathname.split('/')[2];

        jQuery.ajax(
            '/ajax/save_menu.php',
            {
                type:"POST",
                data: ({id:Id, jsonContent:JSON.stringify(objectResult)}),
                dataType: "html",
                success: function(data) {
                    const data_response = JSON.parse(data);
                    if(data_response) jQuery('.result_save').text("Данные сохранены!!!");
                },
                error: function() {
                  alert('There was some error performing the AJAX call!');
                }
             }
          );
    });
    jQuery('.save_price').click(function(){
        let objectResult = [];
        for(i=0; i<jQuery(".wrapper_item_menu").length; i++) {
            let menuItem = {
                menuLink: '',
                menuAnchor: '',
                menuChildren: []
            }
            menuItem.menuLink = jQuery('.wrapper_item_menu').eq(i).find('.main_menu_link').val();
            menuItem.menuAnchor = jQuery('.wrapper_item_menu').eq(i).find('.main_menu_anchor').val();
            for(j=0; j<jQuery('.wrapper_item_menu').eq(i).find('.dropdown_menu_anchor').length; j++) {
                let childrenMenu = {
                    menuLink: '',
                    menuAnchor: '',
                }
                childrenMenu.menuLink = jQuery('.wrapper_item_menu').eq(i).find('.dropdown_menu_link').eq(j).val();
                childrenMenu.menuAnchor = jQuery('.wrapper_item_menu').eq(i).find('.dropdown_menu_anchor').eq(j).val();
                menuItem.menuChildren.push(childrenMenu)
            }
            objectResult.push(menuItem);
        }
        const Id = location.pathname.split('/')[2];
        const postTitle = jQuery('[name=post_title]').val();
		const title = jQuery('[name=title]').val();
		const description = jQuery('[name=description]').val();
        jQuery.ajax(
            '/ajax/save_price.php',
            {
                type:"POST",
                data: ({id:Id,
                    postTitle: postTitle,
                    title: title,
                    description:description,
                    jsonContent:JSON.stringify(objectResult)}),
                dataType: "html",
                success: function(data) {
                    const data_response = JSON.parse(data);
                    if(data_response) jQuery('.result_save').text("Данные сохранены!!!");
                },
                error: function() {
                  alert('There was some error performing the AJAX call!');
                }
             }
          );
    });
    jQuery('.price_accordeon').click(function(){
        let objectResult = [];
        for(i=0; i<jQuery(".wrapper_item_menu").length; i++) {
            let menuItem = {
                menuLink: '',
                menuAnchor: '',
                menuChildren: []
            }
            menuItem.menuLink = replaceCharacters(jQuery('.wrapper_item_menu').eq(i).find('.main_menu_link').val());
            menuItem.menuAnchor = replaceCharacters(jQuery('.wrapper_item_menu').eq(i).find('.main_menu_anchor').val());
            for(j=0; j<jQuery('.wrapper_item_menu').eq(i).find('.dropdown_menu_anchor').length; j++) {
                let childrenMenu = {
                    menuLink: '',
                    menuAnchor: '',
                }
                childrenMenu.menuLink = replaceCharacters(jQuery('.wrapper_item_menu').eq(i).find('.dropdown_menu_link').eq(j).val());
                childrenMenu.menuAnchor = replaceCharacters(jQuery('.wrapper_item_menu').eq(i).find('.dropdown_menu_anchor').eq(j).val());
                menuItem.menuChildren.push(childrenMenu)
            }
            objectResult.push(menuItem);
        }
        const Id = location.pathname.split('/')[2];
        const postTitle = $('.post_title').val();
        let directionId = [];
        let servicesId = [];
        for(i=0; i<jQuery(".select_direction_multiple").length; i++) {
                if(jQuery('.select_direction_multiple').eq(i).prop('checked')) {
                    directionId.push("!"+jQuery('.select_direction_multiple').eq(i).val()+"!");
                }
        }
        for(i=0; i<jQuery(".select_services").length; i++) {
            if(jQuery('.select_services').eq(i).prop('checked')) {
                servicesId.push("!"+jQuery('.select_services').eq(i).val()+"!");
            }
        }
       
        directionId = JSON.stringify(directionId);
        servicesId = JSON.stringify(servicesId);
        console.log(objectResult);
        jQuery.ajax(
            '/ajax/price_accordeon.php',
            {
                type:"POST",
                data: ({id:Id, postTitle:postTitle, directionId: directionId, servicesId: servicesId, jsonContent:JSON.stringify(objectResult)}),
                dataType: "html",
                success: function(data) {
                    const data_response = JSON.parse(data);
                    if(data_response) jQuery('.result_save').text("Данные сохранены!!!");
                    document.location.reload(true);
                },
                error: function() {
                  alert('There was some error performing the AJAX call!');
                }
             }
          );
    });
    if(jQuery('.price_accordeon').length !== 0) {
        if(jQuery(".wrapper_item_menu").length !== 0) jQuery('.add_item_menu_2').remove();
        jQuery('.add_item_menu_2').click(function(){$(this).remove();});
    }
}
EditorMenuSecond();
function replaceCharacters(str){
    const re = /"/gi;
    let newStr = str.replace(re, "&#8243");
    return newStr;
}
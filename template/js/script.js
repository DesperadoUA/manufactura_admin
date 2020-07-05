jQuery(document).ready(function(){
    const URL=document.location.href;
   const URL_FRONT="http://manufacturaclinica.com";
   //const URL_FRONT="http://manufactura/";


$('.summernote').summernote();

const url_edit_page = jQuery("#permalink").val();

// Выбор языка 
jQuery(".select_lang_1").change(function () {
  jQuery(".select_lang_1").prop('checked', false);
  jQuery(this).prop('checked', true);
});
jQuery(".select_lang_2").change(function () {
  jQuery(".select_lang_2").prop('checked', false);
  jQuery(this).prop('checked', true);
});

jQuery("#clear_translate_2").click(function () {
  event.preventDefault();
  jQuery(".select_lang_2").prop('checked', false);
});
jQuery("#clear_translate_1").click(function () {
  event.preventDefault();
  jQuery(".select_lang_1").prop('checked', false);
});

// Выбор направления

jQuery(".select_direction").change(function () {
  jQuery(".select_direction").prop('checked', false);
  jQuery(this).prop('checked', true);
});

jQuery("#clear_direction").click(function () {
  event.preventDefault();
  jQuery(".select_direction").prop('checked', false);
});


// Выбор услуги

jQuery("#clear_services").click(function () {
  event.preventDefault();
  jQuery(".select_services").prop('checked', false);
});

// Выбор врача
jQuery(".select_staff").change(function () {
  jQuery(".select_staff").prop('checked', false);
  jQuery(this).prop('checked', true);
});
jQuery("#clear_doc").click(function () {
  event.preventDefault();
  jQuery(".select_staff").prop('checked', false);
});

// Отображение страницы
jQuery(".show_page").click(function () {
  event.preventDefault();
  window.open(URL_FRONT + url_edit_page, '_blank');
});





  const SLUG="/"+URL.split("/", 4).pop()+"/";
  const array_symbol=new Map([ ['А', 'a'], ['Б', 'b'], ['В', 'v'], ['Г', 'g'], ['Д', 'd'], ['Е', 'e'], ['Ё', 'yo'], ['Є', 'ye'], ['Ж', 'zh'], ['З', 'z'], ['И', 'i'], ['Й', 'j'],['Ј', 'j'], ['І', 'i'], ['Ї', 'yi'], ['К', 'k'], ['Ќ', 'k'], ['Л', 'l'], ['М', 'm'], ['Н', 'n'], ['О', 'o'], ['П', 'p'], ['Р', 'r'], ['С', 's'], ['Т', 't'], ['У', 'u'], ['Ф', 'f'], ['Х', 'h'], ['Ц', 'ts'], ['Ч', 'ch'], ['Ш', 'sh'], ['Щ', 'shh'], ['Ъ', ''], ['Ы', 'y'], ['Ь', ''], ['Э', 'e'], ['Ю', 'yu'], ['Я', 'ya'], ['!', ''], ['"', ''], ['\'', ''], ['@', ''], ['$', ''], ['?', ''], ['%', ''], ['^', ''], [':', ''], ['*', ''], ['+', ''], ['-', '-'], ['=', ''], ['\/', ''], ['.', ''],[' ', '-'], ["1", "1"], ["2", "2"], ["3", "3"], ["4", "4"], ["5", "5"], ["6", "6"], ["7", "7"], ["8", "8"], ["9", "9"], ["0", "0"], ["A", "a"], ["B", "b"], ["C", "c"], ["D", "d"], ["E", "e"], ["F", "f"], ["G", "g"], ["H", "h"], ["I", "i"],["J", "j"], ["J", "j"], ["K", "k"], ["L", "l"], ["M", "m"], ["N", "n"], ["O", "o"], ["P", "p"], ["Q", "q"], ["R", "r"], ["S", "s"], ["T", "t"], ["U", "u"], ["V", "v"], ["W", "w"], ["X", "x"], ["Y", "y"], ["Z", "z"],]);


if(jQuery(".template_add").length!=0)
{
    jQuery("#post_title").on("input",function(ev){
      let current_str=jQuery(ev.target).val();
      updatPermalink(current_str);
    });

    jQuery("#lang_select").change(function(){
        updatPermalink(jQuery("#post_title").val());
    });
}

if(jQuery(".template_edit").length!=0)
{
  jQuery("#permalink").on("input",function(ev){
    let current_str=jQuery(ev.target).val();
    updatePermalinkEdit(current_str);
  });
  jQuery("#lang_select").change(function(){
    updatePermalinkEdit(jQuery("#permalink").val());
});
}

function updatePermalinkEdit(str)
{
  let lang=getLang();
  let start_str=lang+SLUG;
  let modify_string=str.slice(start_str.length);
  let new_url=start_str+transliteral_str(modify_string, array_symbol)+"/";
  jQuery("#permalink").val(new_url);
}
function updatPermalink(str)
    {
      let lang=getLang()
      jQuery("#permalink").val(lang+SLUG+transliteral_str(str, array_symbol)+"/");
    }
    function getLang()
    {
      if(jQuery("#lang_select").val()=="Ru") return "/ru";
      if(jQuery("#lang_select").val()=="Ua") return "";
      if(jQuery("#lang_select").val()=="En") return "/en";
    }

function transliteral_str(str, array_symbol)
{
  let str_local=str.toUpperCase();
  let new_str='';
  for(let i=0; i<str_local.length; i++)
  {
      if(array_symbol.get(str_local[i])){ new_str=new_str+array_symbol.get(str_local[i]); }
      else { new_str=new_str; }
  }
  return new_str;
}

	

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
 
});
const module_1 = document.querySelector('.container_module_1')

if(module_1) {
    
    const mainContainer = document.querySelector('.wrapper_module_1')
    const buttonAdd = document.querySelector('.add_module_1') 
    
    buttonAdd.addEventListener('click', addNewRow)
    mainContainer.addEventListener('click', clickAction)

    function clickAction(event) {
        if(event.target.classList.contains('delete_module_1')) {
            event.target.parentElement.remove()
        } else if (event.target.classList.contains('up_module_1')) {
            if(event.target.parentElement.previousElementSibling) {
                event.target.parentElement.previousElementSibling.before(event.target.parentElement)
            } 
        } else if (event.target.classList.contains('bottom_module_1')) {
            if(event.target.parentElement.nextElementSibling) {
                event.target.parentElement.nextElementSibling.after(event.target.parentElement)
            } 
        }
    }
    function addNewRow() {
        mainContainer.appendChild(createRow())
    function createRow() {

        const row = document.createElement('div')
        row.classList.add('row_module_1')
        
        const item_1 = document.createElement('div')
        item_1.classList.add('item_module_1')
        const input_1 = document.createElement('input')
        input_1.setAttribute('type', 'file')
        input_1.setAttribute('name', 'img_module_1[]')

        const input_1_1 = document.createElement('input')
        input_1_1.setAttribute('type', 'hidden')
        input_1_1.setAttribute('name', 'old_img_module_1[]')

        item_1.appendChild(input_1)
        item_1.appendChild(input_1_1)

        const item_2 = document.createElement('div')
        item_2.classList.add('item_module_1')
        const input_2 = document.createElement('input')
        input_2.setAttribute('type', 'text')
        input_2.setAttribute('name', 'text_1_module_1[]')
        item_2.appendChild(input_2)

        const item_3 = document.createElement('div')
        item_3.classList.add('item_module_1')
        const input_3 = document.createElement('input')
        input_3.setAttribute('type', 'text')
        input_3.setAttribute('name', 'text_2_module_1[]')
        item_3.appendChild(input_3)
        
        const span_1 = document.createElement('span')
        span_1.classList.add('delete_module_1')
        span_1.textContent = 'X'

        const span_2 = document.createElement('span')
        span_2.classList.add('up_module_1')
        span_2.textContent = '⇑'

        const span_3 = document.createElement('span')
        span_3.classList.add('bottom_module_1')
        span_3.textContent = '⇓'

        row.appendChild(item_1)
        row.appendChild(item_2)
        row.appendChild(item_3)
        row.appendChild(span_1)
        row.appendChild(span_2)
        row.appendChild(span_3)
        return row
        }
    }
}
const module_2 = document.querySelector('.container_module_2')
if(module_2) {
    const mainContainer = document.querySelector('.wrapper_module_2')
    const buttonAdd = document.querySelector('.add_module_2')
    const slug = module_2.getAttribute('data-slug')
    
    buttonAdd.addEventListener('click', addNewRow)
    mainContainer.addEventListener('click', clickAction)

    function clickAction(event) {
        if(event.target.classList.contains('delete_module_2')) {
            event.target.parentElement.remove()
        } else if (event.target.classList.contains('up_module_2')) {
            if(event.target.parentElement.previousElementSibling) {
                event.target.parentElement.previousElementSibling.before(event.target.parentElement)
            } 
        } else if (event.target.classList.contains('bottom_module_2')) {
            if(event.target.parentElement.nextElementSibling) {
                event.target.parentElement.nextElementSibling.after(event.target.parentElement) 
            } 
        }
    }
    function addNewRow() {
        mainContainer.appendChild(createRow(slug))
    function createRow(slug) {

        const row = document.createElement('div')
        row.classList.add('row_module_2')
        
        const item_1 = document.createElement('div')
        item_1.classList.add('item_module_2')
        const input_1 = document.createElement('input')
        input_1.setAttribute('type', 'text')
        input_1.setAttribute('name', 'text_1_module_2_'+slug+'[]')
        item_1.appendChild(input_1)

        const item_2 = document.createElement('div')
        item_2.classList.add('item_module_2')
        const input_2 = document.createElement('input')
        input_2.setAttribute('type', 'text')
        input_2.setAttribute('name', 'text_2_module_2_'+slug+'[]')
        item_2.appendChild(input_2)
        
        const span_1 = document.createElement('span')
        span_1.classList.add('delete_module_2')
        span_1.textContent = 'X'

        const span_2 = document.createElement('span')
        span_2.classList.add('up_module_2')
        span_2.textContent = '⇑'

        const span_3 = document.createElement('span')
        span_3.classList.add('bottom_module_2')
        span_3.textContent = '⇓'

        row.appendChild(item_1)
        row.appendChild(item_2)
        row.appendChild(span_1)
        row.appendChild(span_2)
        row.appendChild(span_3)
        return row
        }
    }
}
const module_3 = document.querySelector('.container_module_3')

if(module_3) {
	const mainContainer = document.querySelector('.wrapper_module_3')
	const buttonAdd = document.querySelector('.add_module_3')
	const slug = module_3.getAttribute('data-slug')

	buttonAdd.addEventListener('click', addNewRow)
	mainContainer.addEventListener('click', clickAction)

	function clickAction(event) {
		if(event.target.classList.contains('delete_module_3')) {
			event.target.parentElement.remove()
		} else if (event.target.classList.contains('up_module_3')) {
			if(event.target.parentElement.previousElementSibling) {
				event.target.parentElement.previousElementSibling.before(event.target.parentElement)
			}
		} else if (event.target.classList.contains('bottom_module_3')) {
			if(event.target.parentElement.nextElementSibling) {
				event.target.parentElement.nextElementSibling.after(event.target.parentElement)
			}
		}
	}
	function addNewRow() {
		mainContainer.appendChild(createRow(slug))
		function createRow(slug) {

			const row = document.createElement('div')
			row.classList.add('row_module_3')

			const item_1 = document.createElement('div')
			item_1.classList.add('item_module_3')

			const input_1 = document.createElement('input')
			input_1.setAttribute('type', 'file')
			input_1.setAttribute('name', 'img_module_3_'+slug+'[]')

			const input_1_1 = document.createElement('input')
			input_1_1.setAttribute('type', 'hidden')
			input_1_1.setAttribute('name', 'old_img_module_3_'+slug+'[]')

			item_1.appendChild(input_1)
			item_1.appendChild(input_1_1)

			const item_2 = document.createElement('div')
			item_2.classList.add('item_module_3')
			const input_2 = document.createElement('input')
			input_2.setAttribute('type', 'text')
			input_2.setAttribute('name', 'text_1_module_3_'+slug+'[]')
			item_2.appendChild(input_2)

			const span_1 = document.createElement('span')
			span_1.classList.add('delete_module_3')
			span_1.textContent = 'X'

			const span_2 = document.createElement('span')
			span_2.classList.add('up_module_3')
			span_2.textContent = '⇑'

			const span_3 = document.createElement('span')
			span_3.classList.add('bottom_module_3')
			span_3.textContent = '⇓'

			row.appendChild(item_1)
			row.appendChild(item_2)
			row.appendChild(span_1)
			row.appendChild(span_2)
			row.appendChild(span_3)
			return row
		}
	}
}
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

	
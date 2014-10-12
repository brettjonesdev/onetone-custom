 jQuery(document).ready(function($) {


jQuery('.onetone_shortcodes,.onetone_shortcodes_textarea').magnificPopup({
  items: {
      src: '#onetone_shortcodes_container',
      type: 'inline'
  }
});
jQuery('.onetone_shortcodes,.onetone_shortcodes_textarea').on('click',function(){
			 jQuery("#onetone_shortcodes_container").show();																 
        });

jQuery('.onetone_shortcodes_textarea').on("click",function(){
			var id = jQuery(this).next().find("textarea").attr("id");
			jQuery('#onetone-shortcode-textarea').val(id);
		});																	   

jQuery('.onetone_shortcodes_list li a.onetone_shortcode_item').on("click",function(){
													  
  var obj       = jQuery(this);
  var shortcode = obj.data("shortcode");
  var form      = obj.parents("div#onetone_shortcodes_container form");
  
   jQuery.ajax({
		type: "POST",
		url: onetone_params.ajaxurl,
		dataType: "html",
		data: { shortcode: shortcode, action: "onetone_shortcode_form" },
		success:function(data){
	
		   form.find(".onetone_shortcodes_list").hide();
		   form.find("#onetone-shortcodes-settings").show();
		   form.find("#onetone-shortcodes-settings .current_shortcode").text(shortcode);
		   form.find("#onetone-shortcodes-settings-inner").html(data);
		}
		});
	
});

jQuery(".onetone-shortcodes-home").bind("click",function(){
            jQuery("#onetone-shortcodes-settings").hide();
		    jQuery("#onetone-shortcodes-settings-innter").html("");
		    jQuery(".onetone_shortcodes_list").show();
		   
		});
		
// insert shortcode into editor
jQuery(".onetone-shortcode-insert").bind("click",function(e){

    var obj       = jQuery(this);
	var form      = obj.parents("div#onetone_shortcodes_container form");
	var shortcode = form.find("input#onetone-curr-shortcode").val();

	jQuery.ajax({
		type: "POST",
		url: onetone_params.ajaxurl,
		dataType: "html",
		data: { shortcode: shortcode, action: "onetone_get_shortcode",attr:form.serializeArray()},
		
		success:function(data){
		
		jQuery.magnificPopup.close();
		form.find("#onetone-shortcodes-settings").hide();
		form.find("#onetone-shortcodes-settings-innter").html("");
		form.find(".onetone_shortcodes_list").show();
        form.find(".onetone-shortcode").val(data);
		if(jQuery('#onetone-shortcode-textarea').val() !="" ){
			var textarea = jQuery('#onetone-shortcode-textarea').val();
			if(textarea !== "undefined"){
		    var position = jQuery("#"+textarea).getCursorPosition();
			var content = jQuery("#"+textarea).val();
            var newContent = content.substr(0, position) + data + content.substr(position);
            jQuery("#"+textarea).val(newContent);
			
			}
			}else{
		window.onetone_wpActiveEditor = window.wpActiveEditor;
		// Insert shortcode
		window.wp.media.editor.insert(data);
		// Restore previous editor
		window.wpActiveEditor = window.onetone_wpActiveEditor;
		}
		},
		error:function(){
			jQuery.magnificPopup.close();
		// return false;
		}
		});
		// return false;
   });

 //preview shortcode

jQuery(".onetone-shortcode-preview").bind("click",function(e){

    var obj       = jQuery(this);
	var form      = obj.parents("div#onetone_shortcodes_container form");
	var shortcode = form.find("input#onetone-curr-shortcode").val();

	jQuery.ajax({
		type: "POST",
		url: onetone_params.ajaxurl,
		dataType: "html",
		data: { shortcode: shortcode, action: "onetone_get_shortcode",attr:form.serializeArray()},
		
		success:function(data){
      
		jQuery.ajax({type: "POST",url: onetone_params.ajaxurl,dataType: "html",data: { shortcode: data, action: "onetone_shortcode_preview"},	
		success:function(content){
			jQuery("#onetone-shortcode-preview").html(content);
	        tb_show(shortcode + " preview","#TB_inline?width=600&amp;inlineId=onetone-shortcode-preview",null);
			}
		});
	
		},
		error:function(){
			
		// return false;
		}
		});
		// return false;
   });

/////

 });
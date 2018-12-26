jQuery(document).ready(function(){
	jQuery(".rm_options").slideUp();
	
	 jQuery('.rm_section h3').click(function(){  
            if(jQuery(this).parent().next('.rm_options').css('display')==='none')  
                {   
					jQuery(this).removeClass('inactive').addClass('active').children('img').removeClass('inactive').addClass('active');  
                }  
            else  
                {   jQuery(this).removeClass('active').addClass('inactive').children('img').removeClass('active').addClass('inactive');  
                }  
  
            jQuery(this).parent().next('.rm_options').slideToggle('slow');  
       }); 

});
	
	
    jQuery(document).ready(function() {
		var elementCounter =  jQuery("#landing_num_video").val();  
        jQuery("#add-video").click(function() {  
            var elementRow = jQuery("#videoExample").clone();  
            var newId = "video-" + elementCounter;  
                 
            elementRow.attr("id", newId);  
            elementRow.show();  
                 
            var inputField = jQuery("textarea", elementRow);  
            inputField.attr("name", "video-" + elementCounter);   
			inputField.addClass('videoInput');
			
            var labelField = jQuery("label", elementRow);  
            labelField.attr("for", "video-" + elementCounter);   
			labelField.empty().append('Слайд '+ elementCounter);
  
			var removeLink = jQuery("a", elementRow).click(function() {  
				removeElement(elementRow);    
				return false;  
			});  	
            elementCounter++;  
            jQuery("#landing_num_video").val(elementCounter);  
                  
            jQuery("#videoListInner").append(elementRow);  
                 
            return false;  
        });  
		jQuery(".removeVideo").click(function(e) {
			elementCounter--;  
            jQuery("#landing_num_video").val(elementCounter);  
			jQuery(this).parent().parent().remove();
			e.preventDefault();
		});
		
		
		/***********************************
			ОТЗЫВЫ
		************************************/
		var opCounter =  jQuery("#landing_num_opinion").val();  
        jQuery("#add-opinion").click(function() {  
            var elementRow = jQuery("#opinionExample").clone();  
            var newId = "opinion-" + opCounter;  
                 
            elementRow.attr("id", newId);  
            elementRow.show();  
                 
            var inputField = jQuery("input", elementRow);  
            inputField.attr("name", "opinion-name-" + opCounter);   
			inputField.addClass('opinionInput');
			
			var selectField = jQuery("select", elementRow);  
            selectField.attr("name", "opinion-select-" + opCounter);   
			selectField.addClass('opinionSelect');
			
            var labelField = jQuery("label", elementRow);  
            labelField.attr("for", "opinion-name-" + opCounter);   
			labelField.empty().append('Слайд '+ opCounter);
  	
            opCounter++;  
            jQuery("#landing_num_opinion").val(opCounter);  
                  
            jQuery("#opinionListInner").append(elementRow);  
                 
            return false;  
        }); 
		jQuery(".removeOpinion").click(function(e) {
			opCounter--;  
            jQuery("#landing_num_opinion").val(opCounter);  
			jQuery(this).parent().parent().remove();
			e.preventDefault();
		});
		/***********************************
			ПРИМЕРЫ РАБОТ
		************************************/
		var exampleCounter =  jQuery("#landing_num_example").val();  
        jQuery("#add-example").click(function() {  
            var elementRow = jQuery("#exampleExample").clone();  
            var newId = "example-" + exampleCounter;  
                 
            elementRow.attr("id", newId);  
            elementRow.show();  
                 
            var inputField = jQuery("input.exampleName", elementRow);  
            inputField.attr("name", "example-name-" + exampleCounter);   
			inputField.addClass('exampleInput');
			
			var inputField = jQuery("input.exampleCity", elementRow);  
            inputField.attr("name", "example-city-" + exampleCounter);   
			inputField.addClass('exampleInput');
			
			var selectField = jQuery("select", elementRow);  
            selectField.attr("name", "example-select-" + exampleCounter);   
			selectField.addClass('exampleSelect');
			
            var labelField = jQuery("label", elementRow);  
            labelField.attr("for", "opinion-name-" + exampleCounter);   
			labelField.empty().append('Слайд '+ exampleCounter);
  	
            exampleCounter++;  
            jQuery("#landing_num_example").val(exampleCounter);  
                  
            jQuery("#exampleListInner").append(elementRow);  
                 
            return false;  
        }); 
		jQuery(".removeExample").click(function(e) {
			exampleCounter--;  
            jQuery("#landing_num_example").val(exampleCounter);  
			jQuery(this).parent().parent().remove();
			e.preventDefault();
		});
		
    });

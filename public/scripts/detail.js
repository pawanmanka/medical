var DetailFn = function(){
    
}

DetailFn.prototype.init = function(){
    this.bindElement();
    this.reviewHandelForm();
    this.questionHandelForm();
}

DetailFn.prototype.bindElement= function(){
  
     
    jQuery(document).on('click','#reviewForm',function(){
               
             jQuery('#reviewFormModal').modal('show');  
    });
}

DetailFn.prototype.reviewHandelForm= function(){
    var self = this;
    var formHandle = "#review_form";
    var $frm = jQuery(formHandle);
    jQuery.validator.setDefaults({ ignore: ".ignore" });
    
    $frm.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'medical-field-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input     

        normalizer: function( value ) {
            return $.trim( value );
        },

        invalidHandler: function (event, validator) { //display error alert on form submit   
            jQuery('.alert-error', $frm).show();
        },

        highlight: function (element) { // hightlight error inputs
            jQuery(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            //error.insertAfter(element.closest('.input-icon'));
            error.insertAfter(element);
        },

        submitHandler: function (form) {
            var params = {};
            params.data = jQuery('#review_form').serializeArray();
            params.type="POST";
            params.success = function(data){
              App.showMessage(data.message,data.status);
              if(data.status == 'success')
              {
                jQuery('#reviewFormModal').modal('hide');
              }
            }
          
            App.sendRequest('/saveReview', params);
            return false;
        }
    });

    jQuery(formHandle+'input').keypress(function (e) {
        if (e.which == 13) {	            	
            if ($frm.validate().form()) {
                App.formSubmit($frm);
            }
            return false;
        }
    });
}
DetailFn.prototype.questionHandelForm= function(){
    var self = this;
    var formHandle = "#question_form";
    var $frm = jQuery(formHandle);
    jQuery.validator.setDefaults({ ignore: ".ignore" });
    
    $frm.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'medical-field-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input     

        normalizer: function( value ) {
            return $.trim( value );
        },

        invalidHandler: function (event, validator) { //display error alert on form submit   
            jQuery('.alert-error', $frm).show();
        },

        highlight: function (element) { // hightlight error inputs
            jQuery(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            //error.insertAfter(element.closest('.input-icon'));
            error.insertAfter(element);
        },

        submitHandler: function (form) {
            var params = {};
            params.data = jQuery('#question_form').serializeArray();
            params.type="POST";
            params.success = function(data){
              App.showMessage(data.message,data.status);
              if(data.status == 'success')
              {
                jQuery('#questionFormModal').modal('hide');
              }
            }
          
            App.sendRequest('/saveQuestion', params);
            return false;
        }
    });

    jQuery(formHandle+'input').keypress(function (e) {
        if (e.which == 13) {	            	
            if ($frm.validate().form()) {
                App.formSubmit($frm);
            }
            return false;
        }
    });
}
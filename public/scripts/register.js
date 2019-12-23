var RegisterFn = function(){
    this.table;
}

RegisterFn.prototype.init = function(){
    this.handleForm();
    this.bindElement();
}

RegisterFn.prototype.bindElement = function(){
    var self = this;
    App.validFileType(jQuery('#profile_image'));
}
RegisterFn.prototype.categorySubCategory = function(categoryArr,id){
    var self = this;
    jQuery(document).on('change','#category_id',function(){
            App.getSubCategory(categoryArr,jQuery(this).val(),'subcategory_id') 
    });
}



RegisterFn.prototype.handleForm = function(){
	var formHandle = "#register_form";
	var $frm = jQuery(formHandle);
	jQuery.validator.setDefaults({ ignore: ".ignore" });
	
	$frm.validate({
        // errorElement: 'span', //default input error message container
        // errorClass: 'medical-field-error', // default input error message class
        // focusInvalid: false, // do not focus the last invalid input     

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
        	App.formSubmit(form);
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

RegisterFn.prototype.verifyInit=function(mobile){
    jQuery(document).ready(function() {
        jQuery(".resend").hide();
            setTimeout(function() {jQuery(".resend").show();}, 10000);
    });

    jQuery(document).on('click','.resend',function(e){
        e.preventDefault();
        var params = {};
        params.data = {
            'mobile':mobile
          };

        params.success = function(data){
          App.showMessage(data.message,data.status);
          if(data.status == 'success')
          {
            jQuery(".resend").hide();
            setTimeout(function() {jQuery(".resend").show();}, 10000);
          }
        }
        App.sendRequest('/resendVerifyOtp', params);
  });
}
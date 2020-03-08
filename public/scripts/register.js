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
    jQuery('#term_and_condition').change(function(){
        if(jQuery(this).is(':checked')){
                 jQuery('.handleError').html('');
        }
    });
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
    
var errorMessage = "ww";
	jQuery.validator.addMethod("checkIdProof", function(value1, element) {
       var type = jQuery('.id_proof_type').val();
       var value = value1.length;
        var max = 9999999;
        var min = 0;

       if(parseInt(type) === 1){
          max = 12
          min = 12
          errorMessage = "Please enter only 12 digit";
       } 
       else if(parseInt(type) === 3){
          max = 9
          min = 9
          errorMessage = "Please enter only 9 digit";
       } 
       else{
           return true;
       }
 
       return value == max && value == min?true:false; // return true if field is ok or should be ignored
    },(parseInt(jQuery('.id_proof_type').val()) === 1?"Invalid Input":"Invalid Input"));
	$frm.validate({
        // errorElement: 'span', //default input error message container
        // errorClass: 'medical-field-error', // default input error message class
        // focusInvalid: false, // do not focus the last invalid input     
        rules:{
          
            contact_number:{
                required:true,
                minlength:10,
                maxlength:10,
            }
            },
            messages:{
                contact_number:"Enter your mobile no"
                },            
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
         //   jQuery('.handleError').html('');
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            //error.insertAfter(element.closest('.input-icon'));
            if(element.closest('#term_and_condition').length >0){
                jQuery('.handleError').html('<br><label class="error">Please accept Term and condition</label>');

            }else{
                error.insertAfter(element);
            }
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
var ProfileFn = function(){

}


ProfileFn.prototype.init = function(){
        this.handleForm('#profile_form');
}
ProfileFn.prototype.initExtraInfo = function(){
        this.handleForm('#profile_form');
        this.bindElement();
        this.dataPickerElement();
}

ProfileFn.prototype.dataPickerFn = function(className){
    var id =className+'_1';
    var id1 =className+'_2';
    jQuery('#'+id).datetimepicker({format: 'LT'});
    jQuery('#'+id1).datetimepicker({
        format: 'LT',
        useCurrent: false //Important! See issue #1075
    });
    jQuery("#"+id).on("dp.change", function (e) {
        jQuery('#'+id1).data("DateTimePicker").minDate(e.date);
    });
    jQuery("#"+id1).on("dp.change", function (e) {
        jQuery('#'+id).data("DateTimePicker").maxDate(e.date);
    });
}
ProfileFn.prototype.dataPickerElement = function(){
  
    this.dataPickerFn('m_s_datetimepicker_m');
    this.dataPickerFn('m_s_datetimepicker_e');
    this.dataPickerFn('s_datetimepicker_m');
    this.dataPickerFn('h_s_m_datetimepicker_m');
    this.dataPickerFn('h_s_m_datetimepicker_e');
    this.dataPickerFn('h_s_datetimepicker_m');
}
ProfileFn.prototype.bindElement = function(){
     jQuery('#home_visit').click(function(){
          if(jQuery(this).is(':checked')){
              jQuery('#home_visit_div').show();
            }
            else{
                jQuery('#home_visit_div').hide();
          }
     });
}
ProfileFn.prototype.categorySubCategory = function(categoryArr){
    App.getSubCategory(categoryArr,jQuery('#category_id option:selected').val(),'subcategory_id') 
    jQuery(document).on('change','#category_id',function(){
        App.getSubCategory(categoryArr,jQuery(this).val(),'subcategory_id') 
    });

}

ProfileFn.prototype.handleForm = function(formHandle){
    var self = this;
  
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


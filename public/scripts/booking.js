var BookingFn = function(){}

BookingFn.prototype.init = function(){
    this.handleForm();
    this.bindElement();
}
BookingFn.prototype.bindElement = function(){
     var self =this;
     
    jQuery('#date').datetimepicker({
       // format:"DD-MM-YYYY"
    });
    jQuery("#date").on("dp.change", function (e) {
        if(doctor != undefined){
        self.getSlot();
        }
    });

    jQuery(document).on('click','.sbox-7',function(e){
           e.preventDefault();
           if(doctor != undefined){

               jQuery('.sbox-7').removeClass('selected');
               jQuery(this).addClass('selected');  
               activeSlot = jQuery(this).find('input').val();
               jQuery('#activeSlot').val(activeSlot);
               jQuery('form').attr('action',SITE_URL+'/booking/'+doctor+'/'+activeSlot);
           }

    })

}

BookingFn.prototype.getSlot = function(){
    var params = {};
    params.data = {
        '_token':jQuery('[name="csrf_token"]').attr('content') ,
        'date':jQuery('#date').val()
    };
    params.type = 'post';
    params.success = function(data){
      if(data.status == 'success')
      {
             jQuery('.slot_body_div').show();
             jQuery('#slot_body').html(data.slots);
      }
      else{
        jQuery('.slot_body_div').hide();
        jQuery('#slot_body').html('');
        App.showMessage(data.message,data.status);
      }
    }
    App.sendRequest('/booking/'+doctor+'/get-slots', params);
}
   

BookingFn.prototype.handleForm = function() {
    var self = this;
    var formHandle = "#slot_form_date";
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
            if(jQuery(".slot_body_div").is(":visible") && jQuery('.selected').length == 0){
              App.showMessage('Please Select Valid Slot','error');
            }
          //  error.insertAfter(element);
        },

        submitHandler: function (form) {
            App.formSubmit($frm);
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
};
var UserFn = function(){
    this.currentSegment = null;
    this.gridUrl = null;
    this.table;
}

UserFn.prototype.init = function(){
    this.gridUrl = SITE_URL+'/'+this.currentSegment+'/grid';
    this.grid();
    this.bindListElement();
}
UserFn.prototype.initForm = function(){
    this.handleForm();
    this.bindElement();
}

UserFn.prototype.bindListElement = function(){
    var self = this;

    jQuery(document).on('click','.deleteUser',function(e){
          e.preventDefault();
          var id = jQuery(this).attr('data_id');
          var data = {};
		data.success = function(){
          var params = {};
          params.data = {
              'id':id,
              '_token':jQuery('[name="csrf_token"]').attr('content')            
            };
          params.type = 'post';
          params.success = function(data){
            App.showMessage(data.message,data.status);
            if(data.status == 'success')
            {
                self.table.fnDraw();
            }
          }
          App.sendRequest('/'+self.currentSegment+'/delete', params);
   
        }
          App.showConfirm(jQuery(this),e,data);
    });

}
UserFn.prototype.bindElement = function(){
    
}


UserFn.prototype.handleForm = function() {
	var formHandle = "#user_form";
	var $frm = jQuery(formHandle);
	jQuery.validator.setDefaults({ ignore: ".ignore" });
	
	$frm.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'medical-field-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input     
        rules:{
            password_confirmation: {
              equalTo: "#password"
            }
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
};


UserFn.prototype.grid = function(){
    var self = this;

    var params = {};
      
    params.order = [ [ 0, 'desc' ] ];
    params.columnDefs = [{
        'targets' : -1,
        'orderable'	: false,
        'searchable':false
    },
    ];
   
    self.table = App.showDataTable(jQuery('#user_table'),this.gridUrl, params);
}


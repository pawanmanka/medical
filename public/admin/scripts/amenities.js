var AmenitiesFn = function(){
    this.gridUrl = null;
    this.table;
}

AmenitiesFn.prototype.init = function(){
    this.gridUrl = SITE_URL+'/amenities/grid';
    this.grid();
    this.bindListElement();
}
AmenitiesFn.prototype.initForm = function(){
    this.handleForm();
    this.bindElement();
}

AmenitiesFn.prototype.bindListElement = function(){
    var self = this;

    jQuery(document).on('click','.deleteAmenities',function(e){
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
          App.sendRequest('/amenities/delete', params);
   
        }
          App.showConfirm(jQuery(this),e,data);
    });

}
AmenitiesFn.prototype.bindElement = function(){
    $("#categoryImageUpload").change(function() {
        App.previewImage(this,'categoryImage');
      });
    
}


AmenitiesFn.prototype.handleForm = function() {
	var formHandle = "#amenities_form";
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


AmenitiesFn.prototype.grid = function(){
    var self = this;

    var params = {};
      
    params.order = [ [ 0, 'desc' ] ];
    params.columnDefs = [{
        'targets' : -1,
        'orderable'	: false,
        'searchable':false
    },
    ];
   
    self.table = App.showDataTable(jQuery('#amenities_table'),this.gridUrl, params);
}


var ProductFn = function(){
    var slotIndex;
   }
   
   
   ProductFn.prototype.init = function(gridUrl) {
       this.gridUrl = gridUrl; 
       this.table = jQuery('#product_table');
       this.grid();
       this.bindListElement();
   }
   
   ProductFn.prototype.bindListElement = function(){
       var self = this;
   }
   
   ProductFn.prototype.initCreateSlot = function(){
       var self = this;
       this.dataPickerFn();
       this.handleForm();
       this.bindCreateSlot();
   
   }
   ProductFn.prototype.bindCreateSlot = function(){
       var self = this;
        
       if(jQuery('.slot_create_form').attr('data-id').length > 0){
           self.getSlot();
       }
      jQuery('#apply').click(function(e) {
          e.preventDefault();
          self.getSlot();
      });
   
      jQuery(document).on('click','.edit_slot_item',function(e) {
          e.preventDefault();
             self.slotIndex = jQuery(this).attr('data-index');
             jQuery('#edit_slot_actual_fee').val(jQuery('#actual_fee_'+self.slotIndex).val());
             jQuery('#edit_slot_discount_fee').val(jQuery('#discount_fee_'+self.slotIndex).val());
             jQuery('#edit_slot_availability').val(jQuery('#availability_'+self.slotIndex).val());
            
             jQuery('#edit_slot_modal').modal('show');
      });
   
   }
   
   ProductFn.prototype.handleForm = function() {
       var self = this;
       var formHandle = "#edit_slot_form";
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
               jQuery('#slot_item_'+self.slotIndex).find('#actual_fee_'+self.slotIndex).val(jQuery('#edit_slot_actual_fee').val());
               jQuery('#slot_item_'+self.slotIndex).find('#discount_fee_'+self.slotIndex).val(jQuery('#edit_slot_discount_fee').val());
               jQuery('#slot_item_'+self.slotIndex).find('#availability_'+self.slotIndex).val(jQuery('#edit_slot_availability').val());
               jQuery('#slot_item_'+self.slotIndex).find('.p-sm spam').html(jQuery('#edit_slot_actual_fee').val());
               jQuery('#edit_slot_modal').modal('hide');
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
   
   ProductFn.prototype.getSlot = function(){
       var dataArr =  jQuery('#slot_form').serializeArray();
       var params = {};
       params.data = dataArr;
       params.type = 'get';
       params.success = function(data){
         if(data.status == 'success')
         {
             jQuery('#slot_form_date').find('input[name="date"]').val(data.post.date);
             jQuery('#slot_form_date').find('input[name="time_start"]').val(data.post.time_start);
             jQuery('#slot_form_date').find('input[name="time_end"]').val(data.post.time_end);
             jQuery('.slot_body_div').show();
             jQuery('#slot_body').html(data.slots);
         }
         else{
           App.showMessage(data.message,data.status);
         }
       }
       App.sendRequest('/get-slots', params);
   }
   
   ProductFn.prototype.dataPickerFn = function(){
       var self = this;
       var id ='time_start';
       var id1 ='time_end';
       var dateId ='date';
   
       jQuery('#'+dateId).datetimepicker({
           format:"DD-MM-YYYY"
       });
   
       jQuery('#'+id).datetimepicker({format: 'LT'});
       jQuery('#'+id1).datetimepicker({
           format: 'LT',
           useCurrent: false 
       });
       jQuery("#"+id).on("dp.change", function (e) {
           jQuery('#'+id1).data("DateTimePicker").minDate(e.date);
       });
       jQuery("#"+id1).on("dp.change", function (e) {
           jQuery('#'+id).data("DateTimePicker").maxDate(e.date);
        
       });
   
       
   }
   
   ProductFn.prototype.grid = function(){
       var self = this;
       var params = {};
       params.order = [ [ 0, 'desc' ] ];
       params.columnDefs = [{
           'targets' : -1,
           'orderable'	: false,
           'searchable':false
       },
       ];
       self.table = App.showDataTable(this.table,this.gridUrl, params);
   }

   ProductFn.prototype.initLabFrom = function(){
    var self = this;
    this.labHandleForm();
}

ProductFn.prototype.labHandleForm = function() {
    var self = this;
    var formHandle = "#add_edit_lab_from";
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

   
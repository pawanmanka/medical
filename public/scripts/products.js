var ProductFn = function(){

}


ProductFn.prototype.init = function() {
    this.gridUrl = SITE_URL+'/products/grid';
    this.grid();
    this.bindListElement();
}

ProductFn.prototype.bindListElement = function(){
    var self = this;
}

ProductFn.prototype.initCreateSlot = function(){
    var self = this;
    this.dataPickerFn();
    this.bindCreateSlot();

}
ProductFn.prototype.bindCreateSlot = function(){
    var self = this;
     
   jQuery('#apply').click(function(e) {
       e.preventDefault();
       self.getSlot();
   });

   jQuery(document).on('click','.edit_slot_item',function(e) {
       e.preventDefault();
          var slotIndex = jQuery(this).attr('data-index');
          jQuery('#edit_slot_modal').modal('open');
   });

}


ProductFn.prototype.getSlot = function(){
    var params = {};
    params.data = jQuery('#slot_form').serializeArray();
    params.type = 'get';
    params.success = function(data){
      if(data.status == 'success')
      {
          
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
    self.table = App.showDataTable(jQuery('#product_table'),this.gridUrl, params);
}

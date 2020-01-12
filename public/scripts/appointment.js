var AppointmentFn = function(){

}

 
AppointmentFn.prototype.init = function() {
    this.gridUrl = SITE_URL+'/appointment/grid'; 
    this.table = jQuery('#appointment_table');
    this.grid();
    this.bindElement();
}

   
AppointmentFn.prototype.bindElement = function(){
         var self = this;

         jQuery(document).on('click','.cancelAppointment',function(e){
                e.preventDefault();
                var _this = this;
                var data = {};
                data.success = function(){
                    console.log(jQuery(this).attr('data-href'));

                    window.location.href=jQuery(_this).attr('data-href');
                }  
                App.showConfirm(jQuery(this),e,data);
         })
}
AppointmentFn.prototype.grid = function(){
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
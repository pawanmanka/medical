var AppointmentFn = function(){

}

 
AppointmentFn.prototype.init = function() {
    this.gridUrl = SITE_URL+'/appointment/grid'; 
    this.table = jQuery('#appointment_table');
    this.grid();
   // this.bindElement();
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
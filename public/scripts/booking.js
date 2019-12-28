var BookingFn = function(){}

BookingFn.prototype.init = function(){
    this.bindElement();
}
BookingFn.prototype.bindElement = function(){
     var self =this;

    jQuery('#date').datetimepicker({
        format:"DD-MM-YYYY"
    });

    jQuery("#date").on("dp.change", function (e) {
        
    });
}
   
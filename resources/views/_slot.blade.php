    <div class="col-md-4">
        <div class="sbox-7 icon-xs ">
            
                <div class="sbox-7-txt" id="slot_item_{{$index}}">
                    <input type="hidden" name="actual_fee[{{$index}}]" value="{{$price}}">
                    <input type="hidden" name="discount_fee[{{$index}}]">
                    <input type="hidden" name="availabilty[{{$index}}]">
                    <h5 class="h5-sm steelblue-color">Time: {{$time}} <i data-index="{{$index}}" class="fa fa-pencil-alt  cursor edit_slot_item text-right"></i></h5>
                    <p class="p-sm"> 
                        Fee: <spam>{{$price}}</spam>/-
                    </p>
                </div>
                
        </div>
    </div>
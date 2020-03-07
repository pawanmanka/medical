<div class="col-md-4">
    <div class="sbox-7 icon-xs {{$class}}">
        
            <div class="sbox-7-txt" id="slot_item_{{$index}}">
                <input type="hidden" id="actual_fee_{{$index}}" name="actual_fee[{{$index}}]" value="{{$price}}">
                <input type="hidden" id="discount_fee_{{$index}}" name="discount_fee[{{$index}}]"  value="{{$discount_fee}}">
                <input type="hidden" id="availability_{{$index}}" name="availability[{{$index}}]"  value="{{$availability}}">
                <h5 class="h5-sm steelblue-color">Time: {{$time}} <i data-index="{{$index}}" class="fas fa-pencil-alt  cursor edit_slot_item text-right"></i></h5>
                <p class="p-sm"> 
                    Fee: <spam>{{$price}}</spam>/-
                </p>
            </div>
            
    </div>
</div>
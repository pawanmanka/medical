 <div id="weekly_days_element">
     @foreach (config('application.week_days') as $item)
        <div class="col-sm-10 mt-20">
        <label class="control-label " for="Availability">{{$item}}</label>
            <table>
                <tr>
                    <td>Morning</td>
                    <td>
                            <div class="input-group input-daterange">
                                    <input id="{{strtolower($item)}}_m_1" data-class="{{strtolower($item)}}_m" type="text" class="form-control  datepickerHandler {{strtolower($item)}}_m" 
                                    placeholder="Start" name="weekly_timing[{{strtolower($item)}}][morning][from]" 
                                    value="{{ old('m_to_s_morning_start',isset($record->weekly_timing[strtolower($item)]->morning->from)?$record->weekly_timing[strtolower($item)]->morning->from:'') }}"
                                    >
                                    <div class="input-group-addon">to</div>
                                    <input id="{{strtolower($item)}}_m_2" type="text" class="form-control  {{strtolower($item)}}_m" placeholder="End" 
                                    name="weekly_timing[{{strtolower($item)}}][morning][to]" 
                                    value="{{ old('m_to_s_morning_start',isset($record->weekly_timing[strtolower($item)]->morning->to)?$record->weekly_timing[strtolower($item)]->morning->to:'') }}"
                                    >
                            </div>
                    </td>
                </tr>
                <tr>
                    <td>Evening</td>
                    <td>

                            <div class="input-group input-daterange">
                                    <input id="{{strtolower($item)}}_e_1" data-class="{{strtolower($item)}}_e" type="text"
                                     class="form-control  datepickerHandler {{strtolower($item)}}_e" placeholder="Start" name="weekly_timing[{{strtolower($item)}}][evening][from]" 
                                     value="{{ old('m_to_s_morning_start',isset($record->weekly_timing[strtolower($item)]->evening->from)?$record->weekly_timing[strtolower($item)]->evening->from:'') }}"

                                     >
                                    <div class="input-group-addon">to</div>
                                    <input id="{{strtolower($item)}}_e_2" type="text" class="form-control  {{strtolower($item)}}_e"
                                     placeholder="End" name="weekly_timing[{{strtolower($item)}}][evening][to]"
                                     value="{{ old('m_to_s_morning_start',isset($record->weekly_timing[strtolower($item)]->evening->to)?$record->weekly_timing[strtolower($item)]->evening->to:'') }}"
                                     >
                            </div>
                    </td>
                </tr>
            </table>  
        </div>
    @endforeach
 </div>
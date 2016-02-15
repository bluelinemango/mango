<option value="0" disabled>select one</option>
@foreach($sub_category as $index)
    <option value="{{$index->id}}">
        {{$index->name}}
    </option>
@endforeach
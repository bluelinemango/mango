<option value="0">select one</option>
@foreach($campaign_obj as $index)
    <option value="{{$index->id}}">
        {{$index->name}}
    </option>
@endforeach
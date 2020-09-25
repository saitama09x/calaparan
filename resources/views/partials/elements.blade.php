@switch($elem)
	@case("select")
		<select id="{{$elem_id}}" class="{{$elem_class}}">
			@foreach($options as $o)
				<option value="{{$o['value']}}">{{$o['label']}}</option>
			@endforeach
		</select>
	@break
	@default
	<span></span>
@endswitch
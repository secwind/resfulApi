<fieldset class="form-group">
	@isset($label)
	<label for="label{{$name}}">{{$label}}</label>
	@endisset

	<textarea  
	name="{{$name}}"
	class="form-control"
	@isset($id)
	id="{{$id}}"
	@endisset
	placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
	style="{{ $errors->has($name) ? 'border-color: red;' : '' }}"
	rows="{{ isset($row) ? $row : 4 }}"
	@isset($required)
	required
	@endisset
	>@isset($value){{$value}}@endisset</textarea>
	
</fieldset>
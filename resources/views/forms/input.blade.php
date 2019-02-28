		<fieldset class="form-group">
			@isset($label)
			<label for="label{{$name}}">{{$label}}</label>
			@endisset
			<input 
			name="{{$name}}"
			class="form-control"
			@isset($id)
			id="{{$id}}"
			@endisset
			placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
			style="{{ $errors->has($name) ? 'border-color: red;' : '' }}"
			type="{{ isset($type) ? $type : 'text' }}" 
			@isset($value)
			value="{{$value}}"
			@endisset
			@isset($required)
			required
			@endisset
			>
		</fieldset>


		{{-- @include('forms.input', [
			'label' => 'New Tasks',
			'name' => 'body', 
			'placeholder' => 'New Tasks Enter...', 
			'value' => '', 
			'type' => 'text', 
			'id' = 'nameID',
			'value' => old('XXXXX'),
			'required' => 'required',
			]
		) --}}
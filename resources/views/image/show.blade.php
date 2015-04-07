@if(!is_null($image) && !is_null($image->data))
<img src="{{ action('ImageController@show', $image->id) . (isset($original) && $original ? '?original' : '') }}"
	data-width="{{ $image->width }}" data-height="{{ $image->height }}" />
@else
<img src="{{ asset('img/placeholder.png') }}" />
@endif
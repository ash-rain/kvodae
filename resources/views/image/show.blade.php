@if(!is_null($image->data))
<img src="{{ action('ImageController@show', $image->id) }}" />
@else
No image
@endif
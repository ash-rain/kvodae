@section('js')
$(".image-upload").each(function() {
	var me = $(this)
	$(this).find("input[type='file']").change(function(event) {
		var files = event.target.files
        	
        	var data = new FormData();
        	data.append("file", files[0])
		data.append("imageable_id", me.data("id"))
		if(!me.is(".new")) data.append("_method", "PATCH");
		data.append("_token", "{{ csrf_token() }}")

		$.ajax({
			url: me.data("submit"),
			type: "POST",
			data: data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data) {
				me.find(".th").html(data)
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.error(textStatus);
			}
		});
	});
})
@stop

<div class="th image-upload {{ !count($images) ? 'new' : '' }}"
	data-submit="{{ !count($images) ? action('ImageController@store') : action('ImageController@update', $images[0]->id) }}"
	data-id="{{ ${$type}->id }}">
	<div class="th">
		@if(count($images))
		@include('image.show', ['image' => $images[0]])
		@endif
	</div>
	<a class="button full">
		<i class="fa fa-image"></i>
		{{ trans('Upload Photo') }}
	</a>
	<input type="file" />
</div>
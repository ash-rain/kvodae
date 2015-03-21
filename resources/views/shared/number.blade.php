@section('js')
$(function(){
	$("input[type='number']").keypress(function(e) {
		if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57))
			e.preventDefault()
	})
})
@parent
@stop
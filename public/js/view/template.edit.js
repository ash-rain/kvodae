var canvas = $("canvas")[0]
var zoom = false

$(canvas).hide()
$("#image img").load(function() {
	var img = $(this)
	if(!img.data("width")) return
	var h = (img.width() / $(canvas).width()) * img.height();
	zoom = $(canvas).width() / img.data("width")
	$(canvas).height(h).show()
	$("#image").hide()
	drawText()
})

$("form").submit(function(){
	$("input[name='draw_data']").val(JSON.stringify(drawConfig))
	console.log($("input[name='draw_data']").val())
})

$("input[name='text']").bind("keyup change", function() {
	text = $(this).val()
	drawText()
})
$("select[name='font']").bind("keyup change", function() {
	drawConfig.font = $(this).val()
	drawText()
})
$("input[name='font_size']").bind("keyup change", function() {
	drawConfig.font_size = $(this).val()
	drawText()
})
$("select[name='align']").change(function() {
	drawConfig.align = $(this).val()
	drawText()
})
$("input[name='fill']").minicolors({
	position: "top left",
	change: function(hex) {
		drawConfig.fill = hex
		drawText()
	}
})
$("input[name='rotate']").mousedown(function() {
	$(this).mousemove(function() {
		drawConfig.rotate = $(this).val()
		drawText()
	}).mouseup(function() {
		$(this).unbind("mousemove")
	})
}).change(function() {
	drawConfig.rotate = $(this).val()
	drawText()
})

// Drag text

var drago = {}
var dragt = {}
var dragging = false

$(canvas).mousedown(function(e) {
	dragging = true
	drago = { x: e.clientX, y: e.clientY }
	dragt = { x: parseInt(drawConfig.x || 0), y: parseInt(drawConfig.y || 0) }
})
$(document).mousemove(function(e) {
	if(!dragging) return
	var dragd = { x: (e.clientX - drago.x), y: (e.clientY - drago.y) }
	drawConfig.x =  dragt.x + (dragd.x / zoom)
	drawConfig.y = dragt.y + (dragd.y / zoom)
	drawText()
}).mouseup(function(){ dragging = false })

function drawText() {
	if(!canvas || !zoom) return;
	
	paper.setup(canvas);
	paper.view.zoom = zoom
	new paper.Raster($("#image img")[0], paper.view.center)
	var t = new paper.PointText(paper.view.center)
	t.content = text
	t.style = {
		fontFamily: (drawConfig.font || "sans-serif"),
		fontSize: (drawConfig.font_size || 100),
		fillColor: (drawConfig.fill || "#000000"),
		justification: (drawConfig.align || "center"),
		shadowColor: "rgba(0,0,0,0.2)",
		shadowBlur: 2,
		shadowOffset: new paper.Point(-1)
	}

	if(drawConfig.rotate)
		t.rotate(drawConfig.rotate)
	if(drawConfig.x && drawConfig.y)
		t.translate(new paper.Point(drawConfig.x, drawConfig.y))
	paper.view.draw();
}

$(".image-upload").each(function() {
	var me = $(this)
	$(this).find("input[type='file']").change(function(event) {
		var files = event.target.files
        	
        	var data = new FormData();
        	data.append("file", files[0])
		data.append("imageable_id", me.data("id"))
		data.append("imageable", "template")
		if(!me.is(".new")) data.append("_method", "patch");
		data.append("_token", $("input[name='_token']").val())

		$.ajax({
			url: me.data("submit"),
			type: "POST",
			data: data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data) {
				if(me.is(".new")) location.reload()
				else {
					$("#image").html(data)
					drawText()
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
	});
})
var canvas = $("canvas")[0]
var zoom = 1

$(document).ready(function(){
	var img = $("#image img")
	img.load(canvasInit)
	if(img[0].complete) img.load()
})

function canvasInit() {
	var img = $("#image img")
	if(img.width() == 0) {
		// we all have secrets
		setTimeout(canvasInit, 100)
		return
	}
	var h = ($(canvas).width() / img.data("width")) * img.data("height");
	zoom = $(canvas).width() / img.data("width")
	$(canvas).height(h)
	img.hide()
	drawText()
}

// save timeout
var saveTO;
$("input[name='text']").keyup(function() {
	var name = $("input[name='name']");
	var text = $(this).val()
	if(name.data("copy")) name.val(text).focusout()
	drawText()
	if(saveTO) clearTimeout(saveTO)
	saveTO = setTimeout(saveImage, 500)
})

$("input[name='name']").focusout(function() {
	var eq = $(this).val() == $("input[name='text']").val() || !$(this).val().length
	$(this).data("copy", eq)
}).focusout();

function saveImage() {
	$.ajax({
		type: "post",
		url: postUrl,
		data: { 
			data: canvas.toDataURL(),
			imageable_id: productId,
			_method: $("#image").is(".new") ? "POST" : "PATCH",
			_token: $("input[name='_token']").val()
		}
	})
}

function drawText() {
	var text = $("[name='text']").val()
	paper.setup(canvas);
	paper.view.zoom = zoom
	new paper.Raster($("#image img")[0], paper.view.center)
	var t = new paper.PointText(paper.view.center)

	t.content = text
	t.style = {
		fontFamily: (drawConfig.font || "sans-serif"),
		fontSize: (drawConfig.font_size || 14),
		fillColor: (drawConfig.fill || "#000000"),
		justification: "center",
		shadowColor: "rgba(0,0,0,0.2)",
		shadowBlur: 2,
		shadowOffset: new paper.Point(-1)
	}
	
	if(drawConfig.skewX || drawConfig.skewY)
		t.skew(parseInt(drawConfig.skewX) || 0, parseInt(drawConfig.skewY) || 0);
	if(drawConfig.rotate)
		t.rotate( drawConfig.rotate )
	if(drawConfig.x && drawConfig.y)
		t.translate( new paper.Point(drawConfig.x, drawConfig.y) )
	
	paper.view.draw();
}
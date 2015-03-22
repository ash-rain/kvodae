$("#buy").click(function(){
	// Add to cart
	$.post("/cart", { _token: token, id: $(this).data("id") }, function(m) {
		console.log(m)
		var c = $("#cart")
		if(c) c.text(parseInt(c.text()) + 1)
		else $(".top-bar .fa-shopping-cart").parent().append($("<span class='round label'>1</span>"))
	})

	// Animation
	var dolly = $(".th").first()
	dolly = dolly.clone().css({
		position: "absolute",
		top: dolly.offset().top,
		left: dolly.offset().left,
		width: dolly.width(),
		height: dolly.height()
	})
	dolly.css({ border: "none", opacity: 0 })
		.animate({ top: 0, left: $(window).width(), width: 10, height: 10, opacity: 1 }, 100)
	setTimeout(function(){ dolly.remove() }, 500)
	$("body").append(dolly)
})
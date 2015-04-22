$(function(){


$(".button.buy").click(function(){
	// Add to cart
	$.post("/cart", { _token: token, id: $(this).data("id") }, function(m) {
		var c = $("#cart")
		if(c.length) c.text(m)
		else {
			$(".top-bar .fa-shopping-cart").parent().append($("<div id='cart' style='display:hidden'>1</div>"))
		}
		$("#cart").show(300).addClass("highlight")
		setTimeout("$('#cart').removeClass('highlight')", 1000)
	})

	// Animation
	var dolly = $(this).data("anim") ? $($(this).data("anim")).first() : $(this).parents(".th").first()
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

// Product tile actions

var showTimeout; // Action overlay display timeout

$(".product.th").bind("mouseenter click", function() {
	if(showTimeout) clearTimeout(showTimeout)
	showTimeout = setTimeout(function(me) {
		return function() {
			$(".product.th").removeClass("active")
			$(me).addClass("active")
		}
	}(this), 50)
})

$(".product.th").mouseleave(function() {
	$(".product.th").removeClass("active")
})

$(document).ready(function(){
	$(".fadein").fadeIn(500).css("display", "block");
})

// Submit links
$(".submit.button").click(function() {
	$("form")[0].submit()
})


// Checkboxes
$("input[type='checkbox']").each(function() {
	
	var checkedClass = "fa-check-square-o"
	var uncheckedClass = "fa-square-o"
	
	$(this).after("<i class='fa fa-fw checkbox " + ($(this).is(":checked") ? checkedClass : uncheckedClass) +"'></i>")
		.click(function() {
			var isChecked = $(this).is(":checked")
			$(this).next().toggleClass(checkedClass, isChecked)
			$(this).next().toggleClass(uncheckedClass, !isChecked)
		})
		.hide()
})


})
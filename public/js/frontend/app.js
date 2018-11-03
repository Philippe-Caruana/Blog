var flashMessage = document.querySelector('.fade-out');

if(flashMessage !== null)
{
	setTimeout(function(){flashMessage.style.display = 'none'}, 5000);
}

// Internet Explorer 6-11
var isIE = /*@cc_on!@*/false || !!document.documentMode;

function scrollWin(event) {
    
    if(!isIE) {
		event.preventDefault();

		console.log(event);

		if(event.target.hasAttribute("id"))
		{
			var hash = '#' + event.target.attributes.id.value;

			console.log(hash);
		}
		else {
			var hash = event.target.parentElement.attributes.href.value;

			console.log(hash);
		}

		var targetYPos = document.getElementById(hash.substring(1, hash.length)).offsetTop;

		window.scroll({
			top: targetYPos, 
			left: 0, 
			behavior: 'smooth' 
		});
	}
}

function loadChapters(element, event) {
    event.preventDefault();

    var url = event.target.href;
    var container = event.target.parentElement;
    var hash = event.target.attributes.id.value;

    ajaxGet(url, function(response) {
        document.getElementById("articles-container").insertAdjacentHTML("beforeend", response);
        scrollWin(event);
        event.target.style.display = "none";
    });
}

document.addEventListener("scroll", function() {
	
	var scrollPos = window.scrollY;
	var elt = document.getElementById("parallax");
	
	if(elt != null) {

		var eltPos = document.getElementById("parallax").clientHeight;

		if(scrollPos >= eltPos) {
			updateStyle();
		}
		else {
			document.querySelector("header").style.backgroundColor = "rgba(255, 255, 255, 0.8)";

			if(window.innerWidth <= 768) {
				document.querySelector("nav").style.backgroundColor = "rgba(255, 255, 255, 0.8)";
			}
		}
	}
	else {
		updateStyle();
	}
	
	function updateStyle() {

		document.querySelector("header").style.backgroundColor = "white";

		if(window.innerWidth <= 768) {
			document.querySelector("nav").style.backgroundColor = "white";
		}
	}
});

document.querySelector("#menu-left .close-menu").addEventListener("click", function(e) {
	e.preventDefault();
	window.location.hash = "accueil";
});

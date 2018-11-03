// IE9+ Polyfill
if (!Element.prototype.matches)
	Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;

if (!Element.prototype.closest)
	Element.prototype.closest = function(s) {
		var el = this;
		if (!document.documentElement.contains(el)) return null;
		
		do {
			if (el.matches(s)) return el;
			el = el.parentElement || el.parentNode;
		} while (el !== null && el.nodeType === 1);

		return null;
	};

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementsByClassName('delete');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var cancel = document.getElementById('cancel-post-delete');

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) 
{
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

cancel.onclick = function(event) 
{
	event.preventDefault();
	modal.style.display = "none";
}

function showModal(element, event){
  //console.log();
  
  //element.style.display = 'none';
  event.preventDefault();

  var confirmationBtnModal = document.getElementById('confirmation-btn-modal');

  var link = element.getAttributeNode('data-link').value;

  var parent = element.closest('section').getAttribute('id');

  var title = document.getElementsByClassName('modal-header')[0].childNodes['3'];
  
  if(parent == 'comments-panel')
  {
    confirmationBtnModal.setAttribute('title', 'Confirmer la suppression du commentaire');

    title.textContent = "Êtes-vous sûr de vouloir supprimer ce commentaire ?";
  }
  else
  {
    confirmationBtnModal.setAttribute('title', 'Confirmer la suppression de l\'article');

    title.textContent = "Êtes-vous sûr de vouloir supprimer cet article ?";
  }

  confirmationBtnModal.setAttribute('href', link);

  modal.style.display = "block";
  
}


function confirmDelete(ajax_path, id)
{
	if(confirm('Are you surely want to delete?')) {
		$.post(ajax_path, {id: id},
		function(data) {
			$('#msg').html('<p class="text-success m-0 text-end pb-1">'+data.msg+'</p>');
			setTimeout('window.location.reload()', 2000);
		});
	}
}

$(document).ready(function() {
  // Get the current page URL
  var currentUrl = window.location;

  // Remove the active class from all navigation links
  $('.nav-item a').removeClass('active');

  // Add the active class to the navigation link corresponding to the current page
  $('.nav-item a[href="' + currentUrl + '"]').addClass('active');
});

const myCarousel = new Carousel(document.querySelector("#myCarousel"), {
	preload: 1
});

Fancybox.assign('[data-fancybox="carousel-gallery"]', {
	closeButton: "top",
	Thumbs: false,
	Carousel: {
		Dots: true,
		on: {
			change: (that) => {
				myCarousel.slideTo(myCarousel.getPageforSlide(that.page), {
					friction: 0
				});
			}
		}
	}
});

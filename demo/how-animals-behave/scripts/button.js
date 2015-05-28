

	$(document).ready(function() {

		$('.wiggle').wiggle({ speed: 250, wiggles: 1000 });
		$('.wiggle-right').wiggle({ speed: 250, wiggles: 1000, moveto: 'right' });
		$('img.readmore-toggle').hover(function () { this.src = 'images/buttons/readmore.png'; }, function () { this.src = 'images/buttons/readmore.png'; });
		$('img.next-toggle').hover(function () { this.src = 'images/buttons/next.png'; }, function () { this.src = 'images/buttons/next.png'; });
		$('img.back-toggle').hover(function () { this.src = 'images/buttons/back.png'; }, function () { this.src = 'images/buttons/back.png'; });

	});

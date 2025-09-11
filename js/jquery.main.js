(function($){
	$(document).ready(function () {
		initVideoBlocks();
		// scroll to
		$('a[href*=\\#]:not([href=\\#])').on('click', function() {
			let target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.substr(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top - 72
				}, 800);
				return false;
			}
		});
		// mobile menu
		$(".nav-opener").click(function(e) {
			e.preventDefault();
			$('body').toggleClass('nav-active');
		});
		// form
		$('.input-item__input').on('focus', function() {
			$(this).closest('.input-item').addClass('focus');
		});
		$('.input-item__input').on('focusout', function() {
			if ($(this).val() == ''){
				$(this).closest('.input-item').removeClass('focus');
			}
		});
	});
})(jQuery);

// Video blocks play/pause functionality
function initVideoBlocks() {
	const videoBlocks = document.querySelectorAll('.video-block');

	videoBlocks.forEach(block => {
		const playPauseBtn = block.querySelector('.video-block__video-play-pause');
		const video = block.querySelector('video');
		const youtubeIframe = block.querySelector('iframe');

		if (!playPauseBtn) return;
		// Add click handler to play/pause button
		playPauseBtn.addEventListener('click', function(e) {
			e.preventDefault();

			if (video) {
				// Native video
				if (video.paused) {
					video.play();
				} else {
					video.pause();
				}
			} else if (youtubeIframe) {
				// YouTube video
				const iframeSrc = youtubeIframe.src;
				if (iframeSrc.includes('autoplay=1')) {
					// Pause YouTube video
					youtubeIframe.src = iframeSrc.replace('autoplay=1', 'autoplay=0');
				} else {
					// Play YouTube video
					youtubeIframe.src = iframeSrc.replace('autoplay=0', 'autoplay=1');
				}
			}
		});

		if (video) {
			// Native video event listeners
			video.addEventListener('play', () => {
				playPauseBtn.classList.add('is-playing');
			});

			video.addEventListener('pause', () => {
				playPauseBtn.classList.remove('is-playing');
			});

			video.addEventListener('ended', () => {
				playPauseBtn.classList.remove('is-playing');
			});

			// Initial state
			if (!video.paused) {
				playPauseBtn.classList.add('is-playing');
			}
		} else if (youtubeIframe) {
			// YouTube video - check initial state
			const iframeSrc = youtubeIframe.src;
			if (iframeSrc.includes('autoplay=1')) {
				playPauseBtn.classList.add('is-playing');
			}
		}

		// Hover functionality
		block.addEventListener('mouseenter', () => {
			if (playPauseBtn.classList.contains('is-playing')) {
				playPauseBtn.classList.add('is-hovered');
			}
		});

		block.addEventListener('mouseleave', () => {
			playPauseBtn.classList.remove('is-hovered');
		});
	});
}
/* global document */
(function () {
	const sliderContainers = document.querySelectorAll('[data-slider]');

	if (!sliderContainers.length) {
		return;
	}

	sliderContainers.forEach((container) => {
		const track = container.querySelector('[data-slider-track]');
		const dots = container.querySelectorAll('[data-slider-dots] [data-slider-target]');

		if (!track) {
			return;
		}

		let currentIndex = 0;

		const slides = Array.from(track.children);
		const totalSlides = slides.length;

		if (!totalSlides) {
			return;
		}

		const setActiveSlide = (index) => {
			currentIndex = index;
			const offset = index * 100;
			track.style.transform = `translateX(-${offset}%)`;

			dots.forEach((dot) => {
				dot.classList.toggle('is-active', Number(dot.dataset.sliderTarget) === index);
			});
		};

		dots.forEach((dot) => {
			dot.addEventListener('click', () => {
				const targetIndex = Number(dot.dataset.sliderTarget);
				if (Number.isNaN(targetIndex) || targetIndex === currentIndex) {
					return;
				}
				setActiveSlide(targetIndex);
			});
		});

		// Fallback keyboard navigation.
		container.addEventListener('keydown', (event) => {
			if (!['ArrowLeft', 'ArrowRight'].includes(event.key)) {
				return;
			}

			event.preventDefault();
			const direction = event.key === 'ArrowRight' ? 1 : -1;
			const nextIndex = (currentIndex + direction + totalSlides) % totalSlides;
			setActiveSlide(nextIndex);
		});

		setActiveSlide(0);
	});
})();


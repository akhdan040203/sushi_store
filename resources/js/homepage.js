window.scrollSlider = function (direction) {
    const slider = document.getElementById('productSlider');
    if (!slider) return;

    const firstCard = slider.querySelector('.v5-card');
    if (!firstCard) return;

    const cardWidth = firstCard.offsetWidth;
    const gap = 30;
    const scrollAmount = cardWidth + gap;

    slider.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}

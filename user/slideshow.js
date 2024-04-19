var slideIndex = 1;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (slideIndex > slides.length) {slideIndex = 1}
    if (slideIndex < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        if (i == slideIndex-1) {
            slides[i].style.display = "block";
            slides[i].style.animation = "slide-in 1.5s forwards";
        } else if (i == slideIndex-2 || (slideIndex == 1 && i == slides.length-1)) {
            setTimeout(function() {
                slides[i].style.animation = "slide-out 1.5s forwards";
                setTimeout(function() {
                    slides[i].style.display = "none";
                }, 1500);
            }, 500);
        } else {
            slides[i].style.display = "none";
        }
    }
    slideIndex++;
    setTimeout(showSlides, 5000); // Change image every 5 seconds
}
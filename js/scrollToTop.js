// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
        document.getElementById("scrollToTopBtn").style.display = "block";
    } else {
        document.getElementById("scrollToTopBtn").style.display = "none";
    }

    // Move scroll to top button away from footer on mobile
    if(window.innerWidth < 992){
        var footerHeight = document.getElementById("footerId").clientHeight;
        var bodyHeight = Math.max(document.body.clientHeight, document.documentElement.clientHeight);
        var windowSize = window.innerHeight;
        var scrollPos = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        var offset = 0;

        if((scrollPos + windowSize) > (bodyHeight - footerHeight)){
            offset = (scrollPos + windowSize) - (bodyHeight - footerHeight);
            document.getElementById("scrollToTopBtn").style.bottom = (offset + 20).toString() + "px";
        }
        else{
            document.getElementById("scrollToTopBtn").style.bottom = "20px";
        }
    }
    else{
        document.getElementById("scrollToTopBtn").style.bottom = "20px";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    //document.body.scrollTop = 0; // For Safari
    //document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
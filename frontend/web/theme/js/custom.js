$(document).ready(function () {
    setTimeout(() => {
        $('.news-related .info-content a h3').ellipsis({ lines: 2, responsive: true });
        $('.block-type-2 .info-content a h3').ellipsis({ lines: 2, responsive: true });
        $('.block-type-1 .info-content a h3').ellipsis({ lines: 2, responsive: true });
        $('.highlight-block .info-content a h3').ellipsis({ lines: 2, responsive: true });
        $('.aside-news-content .info-content a h3').ellipsis({ lines: 2, responsive: true });
        $('.info-content .desc').ellipsis({ lines: 4, responsive: true });
        document.addEventListener('scroll', (event) => {
            var viewportOffset = document.querySelector(".menu-primary-point").getBoundingClientRect();
            var bottom = viewportOffset.bottom;
            if (bottom < 0) {
                $('.menu-primary').addClass("fixed");
            }
            if (bottom >= 0) {
                $('.menu-primary').removeClass("fixed");
            }
        });
        // Read a page's GET URL variables and return them as an associative array.
        function getUrlVars() {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }
        var searchText= getUrlVars()["search"]||"";
        $("#search-box").val(decodeURI(searchText).replace('+',' '));
    }, 500);

});
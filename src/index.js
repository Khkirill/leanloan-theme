import Siema from "./libs/siema";
import "./navigation";

// Array.from(document.querySelectorAll(".siema")).forEach(selector => {
//     let carousel = new Siema({
//         selector: selector,
//         loop: true
//     });
//     selector.closest(".carousel-block").querySelector(".carousel-control_side_left")
//         .addEventListener("click", e => carousel.next(1, null));
//     selector.closest(".carousel-block").querySelector(".carousel-control_side_right")
//         .addEventListener("click", e => carousel.next(1, null));
// })

let widgetsRecentPost = document.querySelectorAll(".js-widget-recent-carousel");
if (widgetsRecentPost) {
    Array.from(widgetsRecentPost).forEach(selector => {
        let carousel = new Siema({
            selector: selector,
            loop: true
        });
        let prev = selector.closest(".widget-recent").querySelector(".js-control-prev");
        let next = selector.closest(".widget-recent").querySelector(".js-control-next");
        if (prev) {
            prev.addEventListener("click", e => carousel.next(1, null));
        }
        if (next) {
            next.addEventListener("click", e => carousel.next(1, null));
        }
    })
}

/*
window.addEventListener("load", function () {
    let pageButtons = document.querySelectorAll('.js-page-numbers');
    let postsArea = document.getElementById('paged-post');

    if (pageButtons.length) {
        let pagination = pageButtons[0].closest('.pagination');
        let push_obj = {
            prev: window.location.href,
            next: '',
            prev_title: window.document.title,
            next_title: window.document.title
        };
        window.history.pushState(push_obj, '', window.location.href);
    } else {
        return;
    }
    let gridlove_load_ajax_new_count = 0;
    paginationInit(pageButtons);

    function paginationInit(pageButtons) {
        Array.from(pageButtons).forEach(button => button.addEventListener('click', paginationHandler))
    }

    function paginationHandler(e) {
        e.preventDefault();
        let start_url = window.location.href;
        let prev_title = window.document.title;
        let $link = this;
        let page_url = this.getAttribute("href");
        // loadMore.classList.add('loader-active');
        // document.querySelector('.gridlove-loader').style.display = "block";

        let data = new FormData();
        data.append("request", page_url);
        fetch('/wp-admin/admin-ajax.php' + '?action=load_more', {
            method: "POST",
            body: data
        })
            .then(response => response.text())
            .then(html => {
                postsArea.innerHTML = html;
                window.scroll({
                    top: postsArea.offsetTop - 100,
                    behavior: 'smooth'
                })
                paginationInit(document.querySelectorAll('.js-page-numbers'));

                // loadMore.classList.remove('loader-active');
                let n = gridlove_load_ajax_new_count.toString();
                if (page_url !== window.location) {
                    let next_title = '';
                    let push_obj = {
                        prev: start_url,
                        next: page_url,
                        prev_title: prev_title,
                        next_title: next_title
                    };
                    window.document.title = next_title;
                    window.history.pushState(push_obj, '', page_url);
                }
                gridlove_load_ajax_new_count++;
                return false;
            }).catch(error => alert(error));
    }
});
*/

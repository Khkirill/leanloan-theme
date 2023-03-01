export default function swipeDetect(el, callback) {
    let touchSurface = el,
        swipeDirection,
        startX,
        startY,
        distX,
        distY,
        threshold = 150,
        restraint = 100,
        allowedTime = 300,
        elapsedTime,
        startTime,
        isMousedown = false,
        detectTouch = ('ontouchstart' in window) || ('ontouchstart' in document.documentElement) || !!window.ontouchstart || !!window.Touch || !!window.onmsgesturechange || (window.DocumentTouch && window.document instanceof window.DocumentTouch),
        handleSwipe = callback || function (swipeDir) {
        }

    touchSurface.addEventListener('touchstart', function (e) {
        let touchObject = e.changedTouches[0]
        swipeDirection = 'none'
        startX = touchObject.pageX
        startY = touchObject.pageY
        startTime = new Date().getTime();

    }, {passive: true})

    touchSurface.addEventListener('touchmove', function (e) {

    }, {passive: true})

    function isContained(m, e){
        var e=e||window.event
        let c=/(click)|(mousedown)|(mouseup)/i.test(e.type)? e.target : ( e.relatedTarget || ((e.type=="mouseover")? e.fromElement : e.toElement) )
        while (c && c!=m)try {c=c.parentNode} catch(e){c=m}
        if (c==m)
            return true
        else
            return false
    }

    function touchendHandler(e, isMouse = false) {
        let touchObject = isMouse ? e : e.changedTouches[0];
        let distX = touchObject.pageX - startX;
        let distY = touchObject.pageY - startY;
        elapsedTime = new Date().getTime() - startTime
        if (elapsedTime <= allowedTime) {
            if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint) {
                swipeDirection = (distX < 0) ? 'left' : 'right'
            } else if (Math.abs(distY) >= threshold && Math.abs(distX) <= restraint) {
                swipeDirection = (distY < 0) ? 'up' : 'down'
            }
        }
        handleSwipe(e, swipeDirection)
    }

    touchSurface.addEventListener('touchend', function (e) {
        touchendHandler(e);
    }, false)

    if (!detectTouch) {
        document.body.addEventListener('mousedown', function (e) {
            if (isContained(touchSurface, e)) {
                let touchobj = e
                swipeDirection = 'none'
                startX = touchobj.pageX
                startY = touchobj.pageY
                startTime = new Date().getTime()
                isMousedown = true
                e.preventDefault()
            }
        }, false)

        document.body.addEventListener('mousemove', function (e) {
            e.preventDefault()
        }, false)

        document.body.addEventListener('mouseup', function (e) {
            if (isMousedown) {
                touchendHandler(e, true);
                isMousedown = false;
                e.preventDefault();
            }
        }, false)
    }
}

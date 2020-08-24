/*Sidebar apparation*/
var parent = document.querySelector('#hamburger')
var content = document.querySelector('#hamburger-content')
var sidebarbody = document.querySelector('#hamburger-sidebar-body')
var button = document.querySelector('#hamburger-button')
var closebutton = document.querySelector('#hamburger-button-close')
var overlay = document.querySelector('#hamburger-overlay')
var activatedclass = 'hamburger-activated'

sidebarbody.innerHTML = content.innerHTML

button.addEventListener('click', function (e) {
    e.preventDefault()

    this.parentNode.classList.add(activatedclass);
})

button.addEventListener('keydown', function (e) {
    if (this.parentNode.classList.contains(activatedclass)) {
        if (e.repeat === false && e.which === 27) {
            this.parentNode.classList.remove(activatedclass)
        }
    }

})

overlay.addEventListener('click', function (e) {
    e.preventDefault()

    this.parentNode.classList.remove(activatedclass)
})

closebutton.addEventListener('click', function (e) {
    e.preventDefault()

    parent.classList.remove(activatedclass);
})

let cpt = true
let menuitem = document.querySelector('.active')
window.addEventListener('scroll', function (e) {

    e.preventDefault()
    let pos = window.scrollY

    if(window.innerWidth > 750 && pos > 0) {
        if(parent.classList.contains(activatedclass)) {
            parent.classList.remove(activatedclass)
        }
        parent.classList.remove('animate__animated')
        parent.classList.remove('animate__flipOutX')

        if(cpt) {
            parent.classList.add('header-move')
            parent.classList.add('animate__animated')
            parent.classList.add('animate__bounceIn')
            parent.classList.add('animate__faster')
            cpt = false
        }

        window.setTimeout(() => {
            parent.classList.remove('animate__animated')
            parent.classList.remove('animate__bounceIn')
            parent.classList.remove('animate__faster')
        }, 500);

        /*menuitem.classList.remove('active')*/
        menuitem.classList.add('active-move')


    }else if(window.innerWidth > 750 && pos <= 0){
        cpt = true
        parent.classList.add('animate__animated')
        parent.classList.add('animate__flipOutX')

        window.setTimeout(() => {
            parent.classList.remove('header-move')
            parent.classList.remove('animate__flipOutX')
        }, 500);

        parent.classList.remove('animate__animated')
        parent.classList.remove('animate__bounceIn')

        menuitem.classList.remove('active-move')
    }
})

window.onresize = function () {
    if (window.innerWidth > 995) {
        parent.classList.remove(activatedclass)

    }
};

/*var pos;
window.addEventListener('scroll', function (e) {

    pos = window.scrollY
    if (pos > 995) {
        parent.classList.add('hidden')
        parent.classList.remove(activatedclass)
    }

    if (pos < 995) {
        parent.classList.remove('hidden')
    }
});
*/

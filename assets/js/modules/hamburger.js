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


var dropdownmenu = document.querySelectorAll('#hamburger-sidebar-body #dropdown-menu')
var dropdownli = document.querySelectorAll('#hamburger-sidebar-body #dropdown-li')

window.onresize = function () {
    if (window.innerWidth > 1100) {
        parent.classList.remove(activatedclass)
        for (var i = 0; i < dropdownmenu.length; i++) {
            dropdownmenu[i].classList.remove('show')
            dropdownli[i].classList.remove('show')
        }
    }
};


var pos;
window.addEventListener('scroll', function (e) {

    pos = window.scrollY
    if (pos > 300) {
        parent.classList.add('hidden')
        parent.classList.remove(activatedclass)
        for (var i = 0; i < dropdownmenu.length; i++) {
            dropdownmenu[i].classList.remove('show')
            dropdownli[i].classList.remove('show')
        }
    }

    if (pos < 200) {
        parent.classList.remove('hidden')
    }
});
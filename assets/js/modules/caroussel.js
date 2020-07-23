class CarouselTouchPlugin {

    /**
     *
     * @param {Carousel} carousel
     */
    constructor(carousel) {
        carousel.container.addEventListener('dragstart', (e) => { e.preventDefault() })
        carousel.container.addEventListener('mousedown', this.startDrag.bind(this))
        carousel.container.addEventListener('touchstart', this.startDrag.bind(this))
        window.addEventListener('mousemove', this.drag.bind(this))
        window.addEventListener('touchmove', this.drag.bind(this))
        window.addEventListener('mouseup', this.endDrag.bind(this))
        window.addEventListener('touchend', this.endDrag.bind(this))
        window.addEventListener('touchcancel', this.endDrag.bind(this))


        this.carousel = carousel
    }

    /**
     *
     * @param {MouseEvent|TouchEvent} e
     */
    startDrag(e) {
        if (e.touches) {

            if (e.touches.length > 1) {
                return
            } else {
                e = e.touches[0]
            }
        }
        this.origin = { x: e.screenX, y: e.screenY }
        this.width = this.carousel.containerWidth
        this.carousel.disableTransition()

    }

    /**
     *
     * @param {MouseEvent|TouchEvent} e
     */
    drag(e) {
        if (this.origin) {
            let point = e.touches ? e.touches[0] : e
            let translate = { x: point.screenX - this.origin.x, y: point.screenY - this.origin.y }
            if (e.touches && Math.abs(translate.x) > Math.abs(translate.y)) {
                e.preventDefault()
                e.stopPropagation()
            }
            let baseTranslate = this.carousel.currentItem * -100 / this.carousel.items.length
            this.lastTranslate = translate
            this.carousel.translate(baseTranslate + 100 * translate.x / this.width)
        }
    }

    /**
     *
     * @param {MouseEvent|TouchEvent} e
     */
    endDrag() {
        if (this.origin && this.lastTranslate) {
            this.carousel.enableTransition()
            if (Math.abs(this.lastTranslate.x / this.carousel.carouselWidth) > 0.2) {
                if (this.lastTranslate.x < 0) {
                    this.carousel.next()
                } else {
                    this.carousel.prev()
                }
            } else {
                this.carousel.goToItem(this.carousel.currentItem)
            }

        }
        this.origin = null
    }
}



class Carousel {

    /**
     *
     * @param {HTMLElement} element
     * @param {Object} options
     * @param {Object} [options.slidesToScroll=1]
     * @param {Object} [options.slidesVisible=1]
     * @param {boolean} [options.loop=false]
     * @param {boolean} [options.infinite=false]
     * @param {boolean} [options.pagination=false]
     * @param {boolean} [options.navigation=false]
     * @param {boolean} [options.onResize=false]
     *
     */
    constructor(element, options = {}) {
        this.element = element
        this.options = Object.assign({}, {
            slidesToScroll: 1,
            slidesVisible: 1,
            loop: false,
            infinite: false,
            pagination: false,
            navigation: false,
            onResize: false
        }, options)
        if (this.options.loop && this.options.infinite) {
            throw new Error("Un carousel ne peut être à la fois en boucle et en infinie !")
        }
        let children = [].slice.call(element.children)
        this.isMobile = false
        this.isTablette = false
        this.isDesktop = false
        this.currentItem = 0
        this.moveCallBacks = []
        this.offset = 0

        //Modifications du DOM
        this.root = this.createDivWithClass('carousel')
        this.container = this.createDivWithClass('carousel__container')
        this.root.setAttribute('tabindex', '0')
        this.root.appendChild(this.container)
        this.element.appendChild(this.root)
        this.items = children.map((child) => {
            let item = this.createDivWithClass('carousel__item')
            item.appendChild(child)
            return item
        })
        if (this.options.infinite) {
            this.offset = this.options.slidesVisible + this.options.slidesToScroll
            if (this.offset > children.length) {
                console.error("Pas assez d'éléments dans le carousel !", element)
            }
            this.items = [
                ...this.items.slice(this.items.length - this.offset).map(item => item.cloneNode(true)),
                ...this.items,
                ...this.items.slice(0, this.offset).map(item => item.cloneNode(true)),
            ]
            this.goToItem(this.offset, true)
            window.setInterval(() => {
                this.next()
            }, 10000)
        }
        this.items.forEach(item => this.container.appendChild(item))
        this.setStyle()
        this.createNavigation()
        if (this.options.pagination) {
            this.createPagination()
        }

        //Evenements
        this.moveCallBacks.forEach(cb => cb(this.currentItem))
        this.onWindowResize()
        window.addEventListener('resize', this.onWindowResize.bind(this))
        this.root.addEventListener('keyup', e => {
            if (e.key === 'ArrowRight' || e.key === 'Right') {
                this.next()
            } else if (e.key === 'ArrowLeft' || e.key === 'Left') {
                this.prev()
            }
        })
        if (this.options.infinite) {
            this.container.addEventListener('transitionend', this.resetInfinite.bind(this))
        }

        new CarouselTouchPlugin(this)

    }

    /**
     * Applique les bonnes dimensions au carousel
     */
    setStyle() {
        let ratio = this.items.length / this.slidesVisible
        this.container.style.width = (ratio * 100) + "%"
        this.items.forEach(item => item.style.width = ((100 / this.slidesVisible) / ratio) + "%")
    }

    createNavigation() {
        if(this.options.navigation) {
            let nextButton = this.createDivWithClass('carousel__next')
            let prevButton = this.createDivWithClass('carousel__prev')
            this.root.appendChild(nextButton)
            this.root.appendChild(prevButton)
            nextButton.addEventListener('click', this.next.bind(this))
            prevButton.addEventListener('click', this.prev.bind(this))
            if (this.options.loop === true) {
                return
            }
            this.onMove(index => {
                if (index === 0) {
                    prevButton.classList.add('carousel__prev--hidden')
                } else {
                    prevButton.classList.remove('carousel__prev--hidden')
                }
                if (this.items[this.currentItem + this.slidesVisible] === undefined) {
                    nextButton.classList.add('carousel__next--hidden')
                } else {
                    nextButton.classList.remove('carousel__next--hidden')
                }
            })
        }
    }

    createPagination() {
        let pagination = this.createDivWithClass('carousel__pagination')
        let buttons = []
        this.root.appendChild(pagination)
        for (let i = 0; i < (this.items.length - 2 * this.offset); i = i + this.options.slidesToScroll) {
            let button = this.createDivWithClass('carousel__pagination__button')
            button.addEventListener('click', () => this.goToItem(i + this.offset))
            pagination.appendChild(button)
            buttons.push(button)
        }
        this.onMove(index => {
            let count = this.items.length - 2 * this.offset
            let activeButton = buttons[Math.floor(((index - this.offset) % count) / this.options.slidesToScroll)]
            if (activeButton) {
                buttons.forEach(button => button.classList.remove('carousel__pagination__button--active'))
                activeButton.classList.add('carousel__pagination__button--active')
            }
        })
    }

    translate(percent) {
        this.container.style.transform = 'translate3d(' + percent + '%, 0, 0)'
    }

    next() {
        this.goToItem(this.currentItem + this.slidesToScroll)
    }

    prev() {
        this.goToItem(this.currentItem - this.slidesToScroll)
    }

    /**
     *
     * @param {number} index
     * @param {boolean} [animation=true]
     */
    goToItem(index, animation = true) {
        if (index < 0) {
            if (this.options.loop) {
                index = this.items.length - this.slidesVisible
            } else {
                return
            }
        } else if (index >= this.items.length || (this.items[this.currentItem + this.slidesVisible] === undefined && index > this.currentItem)) {
            if (this.options.loop) {
                index = 0
            } else {
                return
            }

        }
        let translateX = index * -100 / this.items.length
        if (animation === false) {
            this.disableTransition()
        }
        this.translate(translateX)
        this.container.offsetHeight //force repaint
        if (animation === false) {
            this.enableTransition()
        }
        this.currentItem = index
        this.moveCallBacks.forEach(cb => cb(index))
    }

    resetInfinite() {
        if (this.currentItem <= this.options.slidesToScroll) {
            this.goToItem(this.currentItem + (this.items.length - 2 * this.offset), false)
        } else if (this.currentItem >= this.items.length - this.offset) {
            this.goToItem(this.currentItem - (this.items.length - 2 * this.offset), false)
        }
    }

    onMove(cb) {
        this.moveCallBacks.push(cb)
    }

    onWindowResize() {
        let mobile = window.innerWidth < 770
        let tablet = window.innerWidth < 995
        let desktop = window.innerWidth > 995
        if (mobile !== this.isMobile) {
            this.isMobile = mobile
            this.setStyle()
            this.moveCallBacks.forEach(cb => cb(this.currentItem))
        }

        if(tablet !== this.isTablette) {
            this.isTablette = tablet
            this.setStyle()
            this.moveCallBacks.forEach(cb => cb(this.currentItem))
        }

        if(desktop !== this.isDesktop) {
            this.isDesktop = desktop
            this.setStyle()
            this.moveCallBacks.forEach(cb => cb(this.currentItem))
        }
    }

    /**
     *
     * @param {string} className
     * @returns {HTMLElement}
     */
    createDivWithClass(className) {
        let div = document.createElement('div')
        div.setAttribute('class', className)
        return div
    }

    disableTransition() {
        this.container.style.transition = 'none'
    }

    enableTransition() {
        this.container.style.transition = ''
    }

    /**
     * @returns {number}
     */
    get slidesToScroll() {
        if(this.isMobile) {
            return 1
        }
        if(this.options.onResize) {
            if(this.isTablette) {
                return 1
            }
            if(this.isDesktop) {
                return 1
            }
        }
        else {
            return this.options.slidesToScroll
        }
    }

    /**
     * @returns {number}
     */
    get slidesVisible() {
        if(this.isMobile) {
            return 1
        }
        if(this.options.onResize) {
            if(this.isTablette) {
                return 2
            }
            if(this.isDesktop) {
                return 3
            }
        }
        else {
            return this.options.slidesVisible
        }
    }

    /**
     * @returns {number}
     */
    get containerWidth() {
        return this.container.offsetWidth
    }

    /**
     * @returns {number}
     */
    get carouselWidth() {
        return this.root.offsetWidth
    }

}

document.addEventListener('DOMContentLoaded', function() {
    new Carousel(document.querySelector('#carousel1'), {
        slidesVisible: 1,
        slidesToScroll: 1,
        pagination: true,
        infinite: true

    })

    new Carousel(document.querySelector('#carousel2'), {
        slidesVisible: 3,
        slidesToScroll: 1,
        infinite: true,
        navigation: true,
        onResize: true

    })
})
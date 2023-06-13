console.log('bonjour!');

window.onload = function() {
    /**
     * @param {HTMLElement} element
     * @param {string[]} images chemins des images de la lightbox
     * @param {string} url images actuellement affiicher
     */
    class Lightbox
    {
        static init ()
        {
            const links = Array.from(document.querySelectorAll('a[href$=".svg"]'))
            const gallery = links.map(link=> link.getAttribute('href'))
            
            links.forEach(link => link.addEventListener('click', e => 
            {
                e.preventDefault()
                new Lightbox(e.currentTarget.getAttribute('href'), gallery)
            }))
        }
        
        /**
         * @param {string} url URL de l'image
         * @param {string[]} images chemins des images de la lightbox
         * (première chose a faire est de construire html de la lightbox voir plus bas)
         */
        constructor (url, images)
        {
            this.element = this.buildDOM(url)
            this.images = images
            this.loadImage(url)
            this.onKeyUp = this.onKeyUp.bind(this)
            document.body.appendChild(this.element)
            document.addEventListener('keyup', this.onKeyUp)
        }

        /**
         * @param {string} url URL de l'image
         * méthode pour charger une image (une image de chargement le temps que la photo souhaite apparaisse)
         */
        loadImage (url)
        {
            this.url = null
            const image = new Image();
            const container = this.element.querySelector('.lightbox__container')
            const loader = document.createElement('div')
            loader.classList.add('lightbox__loader')
            container.innerHTML = ''
            container.appendChild(loader)
            image.onload = () =>
            {
                container.removeChild(loader)
                container.appendChild(image)
                this.url = url
            }
            image.src  = url
        }

        /**
         * @param {KeyboardEvent} e 
         * permet de fermer la lightbox avec la touche echap
         */
        onKeyUp (e)
        {
            if(e.key === 'Escape')
            {
                this.close(e)
            }
            else if (e.key === 'ArrowLeft')
            {
                this.prev(e)
            }
            else if (e.key === 'ArrowRight')
            {
                this.next(e)
            }
        }

        /**
         * @param {MouseEvent/KeyBordEvent} e
         * méthode pour fermer le modale
         */
        close(e)
        {
            e.preventDefault()
            this.element.classList.add('lightbox__fadeOut')
            window.setTimeout(()=>
            {
                this.element.parentElement.removeChild(this.element)
            }, 500)
            document.removeEventListener('keyup', this.onKeyUp)
        }
        
        /**
         * @param {MouseEvent/KeyBordEvent} e
         */
        next(e)
        {
            e.preventDefault()
            let i = this.images.findIndex(image => image === this.url)
            if (i === this.images.length - 1)
            {
                i = -1
            }
            this.loadImage(this.images[i + 1])
        }

        /**
         * @param {MouseEvent/KeyBordEvent} e
         */
        prev(e)
        {
            e.preventDefault()
            let i = this.images.findIndex(image => image === this.url)
            if (i === 0)
            {
                i = this.images.length
            }
            this.loadImage(this.images[i - 1])
        }

        /**
         * @param {string} url URL de l'image
         * (première chose : construire html de la lightbox)
         * @return {HTMLElement}
         */
        buildDOM (url)
        {
            const dom = document.createElement('div')
            dom.classList.add ('lightbox')
            dom.innerHTML = `<button class="lightbox__close"></button>
                <button class="lightbox__next">suivant</button>
                <button class="lightbox__prev">précédent</button>
                <div class="lightbox__container"></div>`
            dom.querySelector('.lightbox__close').addEventListener('click', this.close.bind(this))
            dom.querySelector('.lightbox__next').addEventListener('click', this.next.bind(this))
            dom.querySelector('.lightbox__prev').addEventListener('click', this.prev.bind(this))
            return dom
        }
    }
/**
    * début : lightbox
        <div class="lightbox">
            <button class="lightbox__close"></button>
            <button class="lightbox__next">suivant</button>
            <button class="lightbox__prev">précédent</button>
            <div class="lightbox__container">
                <img src="https://picsum.photos/900/1800" alt="image">
            </div>
        </div>
    * fin: lightbox
*/
    Lightbox.init()
}
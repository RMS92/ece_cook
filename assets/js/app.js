/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import '../css/caroussel.css'
import '../css/hamburger.css'
import '../css/ui.css'
import '../css/form.css'
import '../css/notification.css'

import './modules/hamburger'
import './modules/caroussel'
import '@grafikart/drop-files-element'


import $ from 'jquery'
import Mustache from './modules/mustache'
import Map from '../js/modules/map'
import Address from "./modules/places";

/*Carte de localisation*/
Map.init()
/*
Places: trouve les addresses et remplit les champs automatiquement
 */
Address.init();

//Supression des images admin
document.querySelectorAll('[data-delete]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault()
        fetch(a.getAttribute('href'), {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({'_token': a.dataset.token})
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    a.parentNode.parentNode.removeChild(a.parentNode)
                } else {
                    alert(data.error)
                }
            })
            .catch(e => alert(e))
    })
})

$.fn.notif = function (options) {

    var settings = {
        html: '<div class="notification {{cls}}">\n' +
            '      <div class="right">\n' +
            '          {{#icon}}\n' +
            '           <div class="icon">\n' +
            '                             \n' +
            '           </div>\n' +
            '           {{/icon}}\n' +
            '           {{#img}}\n' +
            '           <div class="img" style="background: url({{img}})  center center / cover no-repeat;  background-size: auto 40%;">\n' +
            '           </div>\n' +
            '           {{/img}}\n' +
            '       </div>\n' +
            '       <div class="left">\n' +
            '            <p>{{content}}</p>\n' +
            '        </div>\n' +
            '   </div>',
        icon: '',
        timeout: false
    }

    if (options.cls === 'infos') {
        settings.icon = '';
    }

    var options = $.extend(settings, options);

    return this.each(function () {
        var $this = $(this);
        var $notifs = $('> .notifications', this);
        var $notif = $(Mustache.render(options.html, options));
        if ($notifs.length === 0) {
            $notifs = $('<div class="notifications animate__animated animate__flipInX"/>');
            $this.prepend($notifs);
        }
        $notifs.append($notif);
        if (options.timeout) {
            setTimeout(function () {
                $notif.trigger('click')
            }, options.timeout)
        }
        $notif.click(function (e) {
            e.preventDefault();
            $notif.addClass('').delay(500, function () {
                if ($notif.siblings().length === 0) {
                    $notifs.remove();
                }
                $notif.remove()
            });
        });

    })
}

let msg = document.querySelector('.notifications')
if (msg.dataset.status === '0') {
    $('.notifications').notif({
        content: msg.dataset.message,
        img: '/images/icone-info.png',
        cls: 'infos',
        timeout: 7000
    });
}
if (msg.dataset.status === '1') {
    $('.notifications').notif({
        content: msg.dataset.message,
        img: '/images/icone-info.png',
        cls: 'infos',
        timeout: 7000
    });
}


// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

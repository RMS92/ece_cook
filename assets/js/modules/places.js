import Places from 'places.js';

export default class Address {

    static init() {

        let inputAddressEvent = document.querySelector('#event_address')

        if (inputAddressEvent) {
            Address.autoFill(inputAddressEvent, 'event');
        }

    }

    static autoFill(inputAddress, name) {
        if (inputAddress !== null) {
            let place = Places({
                container: inputAddress
            })
            place.on('change', e => {
                document.querySelector('#' + name + '_city').value = e.suggestion.city
                document.querySelector('#' + name + '_postal_code').value = e.suggestion.postcode
                document.querySelector('#' + name + '_lat').value = e.suggestion.latlng.lat
                document.querySelector('#' + name + '_lng').value = e.suggestion.latlng.lng
            })
        }
    }
}
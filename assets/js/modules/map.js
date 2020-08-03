import L from 'leaflet'

export default class Map {

    static init() {
        let map = document.querySelector('#map')
        if (map === null) {
            return
        }
        let center = [map.dataset.lat, map.dataset.lng]
        map = L.map('map').setView(center, 14)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 16,
            minZoom: 8,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map)
        L.marker(center).addTo(map);
    }
}
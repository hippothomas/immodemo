<template>
   <div id="map"></div>
</template>

<script>
import L from "leaflet"

export default {
  name: 'Map',
  props: {
    coordinateX: Number,
    coordinateY: Number
  },
  mounted() {
    // Need to reset icon location due to webpack issue
    delete L.Icon.Default.prototype._getIconUrl;
    L.Icon.Default.mergeOptions({
        iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
        iconUrl: require('leaflet/dist/images/marker-icon.png'),
        shadowUrl: require('leaflet/dist/images/marker-shadow.png')
    });
    // Setting up the map
    const map = L.map('map').setView([this.coordinateY, this.coordinateX], 17);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>'
    }).addTo(map);
    L.marker([this.coordinateY, this.coordinateX]).addTo(map);
  }
}
</script>

<template>
  <span class="location">
    <input type="text" name="lieu" id="location" v-model="content" placeholder="Ville ou code postal" />
  </span>
</template>

<script>
import TomSelect from "tom-select"

export default {
  name: 'Location',
  props: {
    content: String,
  },
  data () {
    return {
      tomSelect: null,
    }
  },
  created () {
    this.$nextTick(() => {
      this.tomSelect = new TomSelect('#location',{
        valueField: 'value',
        labelField: 'label',
        searchField: 'label',
        maxItems: 1,
	      plugins: ['dropdown_input', 'clear_button'],
	      persist: false,
        // minimum query length
        shouldLoad: function(query) {
          return query.length >= 3;
        },
        // fetch remote data
        load: function(query, callback) {
          const url = '/api/lieux?search=' + encodeURIComponent(query);
          fetch(url)
            .then(response => response.json())
            .then(json => {
              callback(json.items);
            }).catch((error) => {
              console.error('Error:', error);
              callback();
            });
        },
        // rendering functions for options and items
        render: {
          option: function(item, escape) {
            return `<div class="py-2 d-flex">${ escape(item.label) }</div>`;
          },
          item: function(item, escape) {
            return `<div class="py-2 d-flex">${ escape(item.label) }</div>`;
          },
          no_results: function(item, escape) {
            return `<div class="no-results">Aucun résultat pour ${ escape(item.input) }</div>`;
          },
        },
      });
    })
  },
}
</script>

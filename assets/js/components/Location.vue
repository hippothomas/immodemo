<template>
  <span class="location">
    <input type="text" name="lieu" id="location" v-model="internalContent" placeholder="Ville ou code postal" />
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
      internalContent: this.content,
      tomSelect: null,
    }
  },
  watch: {
    // watch for changes in content prop
    content(newVal) {
      this.internalContent = newVal;
    }
  },
  created () {
    const base_url = '/api/lieux?search=';
    this.$nextTick(() => {
      this.tomSelect = new TomSelect('#location',{
        valueField: 'value',
        labelField: 'label',
        searchField: 'label',
        maxItems: 1,
	      plugins: ['dropdown_input', 'clear_button'],
	      persist: false,
        // if initialized with content
        onInitialize: function() {
          let val = this.getValue();
          if (val !== "") {
            const url = base_url + encodeURIComponent(val);
            this.clear();
            this.clearOptions();
            fetch(url)
              .then(response => response.json())
              .then(json => {
                // if the value is found
                if (json.total_count === 1) {
                  this.addOption(json.items[0]);
                  this.setValue(json.items[0].value);
                }
              }).catch((error) => {
                console.error('Error:', error);
              });
          }
        },
        // minimum query length
        shouldLoad: function(query) {
          return query.length >= 3;
        },
        // fetch remote data
        load: function(query, callback) {
          const url = base_url + encodeURIComponent(query);
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
        onDelete: function() {
          this.internalContent = null;
        }
      });

      this.tomSelect.on('change', () => {
        // send event for parent to update prop
        this.$emit('update:content', this.tomSelect.getValue());
      });
    })
  },
}
</script>

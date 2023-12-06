<template>
    <div class="property-card" :data-id="this.reference">
        <div class="container">
            <div class="photo">
                <a :href="this.path">
                    <img :src="this.photo" :alt="this.title" />
                </a>
            </div>
            <div class="desc">
                <div class="title">
                    <a :href="this.path">
                        {{ this.title }}
                    </a>
                </div>
                <div class="price">{{ this.price }}€</div>
                <div class="city">{{ this.city }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'CardProperty',
  props: {
    reference: String,
    path: String,
    photo: String,
    title: String,
    price: String,
    city: String
  }
}
</script>

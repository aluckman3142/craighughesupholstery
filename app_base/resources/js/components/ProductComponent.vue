<template>
  <div class="w-full bg-cover">
    <div class="w-full bg-gray-100 bg-opacity-60">
      <div class="container mx-auto py-4 max-w-screen-lg">
        <carousel
          :responsive="{0:{items:1},768:{items:1}}"
          :loop="true"
          :autoplay="false"
          :dots="false"
          :navText="['<','>']"
        >
          <div
            v-for="item in items"
            class="relative"
          >
            <div>
              <img
                class="w-full"
                :src="item.src"
              >
            </div>
          </div>
        </carousel>
      </div>
    </div>
  </div>
</template>
<script>
import carousel from 'vue-owl-carousel'

export default {
  components: {
    carousel,
  },
  name: 'products',
  props: {
    items: {
      type: Array,
      required: true,
    },
  },
}
</script>


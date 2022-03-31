<template>
  <div id="app">
    <CoolLightBox
      :items="items"
      :index="index"
      @close="index = null"
    >
    </CoolLightBox>
    <div class="images-wrapper grid grid-cols-2 md:grid-cols-4 gap-0">
      <div
        v-for="(image, imageIndex) in items"
        @click="index = imageIndex"
      >
        <div class="w-full overflow-hidden">
          <img
            v-if="image.thumb" :src="image.thumb"
            class="w-full transform transition duration-300 hover:scale-125"
          >
          <img
            v-else :src="image"
            class="w-full transform transition duration-300 hover:scale-125"
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'

export default {
  name: 'lightbox',
  props: {
    items: {
      type: Array,
      required: true,
    },
  },
  data: function () {
    return {
      index: null,
    }
  },
}
</script>

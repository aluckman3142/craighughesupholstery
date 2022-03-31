<template>
  <div class="w-full">
    <carousel
      :items="1"
      :loop="true"
      :autoplay="true"
      :dots="false"
      :navText="['<','>']"
    >
      <div
        v-for="slider in sliders"
        class="relative"
      >
        <div class="absolute text-white top-1/3 lg:top-1/2 left-10 w-4/5 md:w-2/3">
          <h1 class="text-lg sm:text-xl md:text-4xl font-extrabold uppercase">
            {{ slider.title }}</h1>
          <p class="text-xs sm:text-sm md:text-lg mt-2 font-serif italic">
            {{ slider.text }}
          </p>
          <a :href="slider.button_path">
            <button class="hover:bg-white text-md mt-3 py-2 px-4 bg-gray-200 font-thin text-black">
              {{ slider.button_text }}
            </button>
          </a>
        </div>
        <img
          class="img-fluid"
          :src="slider.image_path"
        >
      </div>
    </carousel>
  </div>
</template>
<script>
import carousel from 'vue-owl-carousel'

export default {
  components: {
    carousel,
  },
  name: 'slider',
  props: {
    sliders: {
      type: Array,
      required: true,
    },
  },
}
</script>


<template>
  <div class="container my-10 mx-auto max-w-screen-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-xs mx-2">
      <vue-flip
        v-for="category in categories"
        :key="category.id"
        :active-hover="true"
        height="13rem"
        width="100%"
      >
        <template
          v-slot:front
          class="front"
        >
          <div class="h-52 overflow-hidden">
            <img
              class="w-full min-h-full"
              :src="category.image_path"
            >
            <div class="w-full bg-black bg-opacity-50 p-2 absolute bottom-0">
              <h1 class="text-white text-2xl font-thin mx-2">{{
                  category.title
                }}</h1>
              <div class="w-1/5 h-1 bg-white m-2"></div>
            </div>
          </div>
        </template>
        <template
          v-slot:back
          class="back"
        >
          <div class="h-52 overflow-hidden border-2 border-dashed border-gray-500 bg-gray-100">
            <div class="w-full">
              <div class="p-10 text-center">
                <p class="w-full h-28 text-lg p-2 font-bold italic font-serif">
                  {{ category.short_desc }}
                </p>
                <a :href="category.button_path">
                  <button class="hover:bg-white text-md mt-2 py-2 px-4 bg-gray-200 font-thin text-black">
                    {{ category.button_text }}
                  </button>
                </a>
              </div>
            </div>
          </div>
        </template>
      </vue-flip>
    </div>
  </div>
</template>

<script>
import VueFlip from 'vue-flip'

export default {
  components: {
    'vue-flip': VueFlip,
  },
  props: {
    categories: {
      type: Array,
      required: true,
    },
  },
}
</script>

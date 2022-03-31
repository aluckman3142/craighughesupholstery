<template>
  <div class="container my-10 mx-auto max-w-screen-lg">
    <div class="grid grid-cols-2 gap-8 text-xs mx-2 mb-8" v-for="category in categories">
      <vue-flip
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
              :src="category.before_src"
            >
          </div>
        </template>
        <template
          v-slot:back
          class="back"
        >
          <div class="h-52 overflow-hidden">
            <img
              class="w-full min-h-full"
              :src="category.after_src"
            >
          </div>
        </template>
      </vue-flip>
      <div>
        <h2 class="font-bold py-2 text-lg text-gray-500">{{category.title}}</h2>
        <p class="py-2 text-md text-gray-700">{{category.description}}</p>
      </div>
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

<template>
  <div class="w-full bg-chaise bg-cover">
    <div class="w-full bg-gray-100 bg-opacity-60">
      <div class="container mx-auto py-10 max-w-screen-lg">
        <h1 class="text-black text-3xl font-thin mx-2 text-center">Customer
          Testimonials</h1>
        <div class="w-1/6 h-1 bg-black m-2 mb-4 mx-auto mt-3"></div>
        <carousel
          :responsive="{0:{items:1},768:{items:2}}"
          :loop="true"
          :autoplay="true"
          :dots="false"
          :navText="['<','>']"
        >
          <div
            v-for="testimonial in testimonials"
            class="relative"
          >
            <div class="mt-10 mx-auto w-1/2 text-center">
              <img
                class="img-fluid"
                :src="testimonial.image_path"
              >
              <i class="fas fa-comment-dots text-4xl text-white mt-4"></i>
              <p class="font-serif text-black text-center mt-4 italic mb-2 text-lg">
                "{{ testimonial.text }}"
              </p>
              <p class="text-center text-md font-thin mb-2 text">
                {{ testimonial.customer_name }} - {{ testimonial.customer_location }}
              </p>
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
  name: 'testimonials',
  props: {
    testimonials: {
      type: Array,
      required: true,
    },
  },
}
</script>


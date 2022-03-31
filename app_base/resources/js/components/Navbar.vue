<template>
  <div class="flex flex-wrap z-10 fixed">
    <div class="fixed w-full">
      <nav class="flex flex-wrap items-center justify-between px-2 py-3 bg-black bg-opacity-50 border-gray-50 border-b-4">
        <div class="w-full px-4 mx-auto flex flex-wrap items-center justify-between">
          <div class="w-full relative flex justify-between md:w-auto md:static md:block md:justify-start">
            <a
              class="text-sm font-bold leading-relaxed inline-block py-2 whitespace-nowrap uppercase text-white"
              href="/"
            >
              <img
                class="fade-in mr-5"
                src="/img/CraigHughesUpholstery-Logo.png"
                alt="Craig Hughes Upholstery"
                width="200"
              /></a>
            <button
              class="h-8 text-white cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block md:hidden outline-none focus:outline-none"
              type="button"
              v-on:click="toggleNavbar()"
            >
              <i class="fas fa-bars"></i>
            </button>
          </div>
          <div
            v-bind:class="{'hidden': !menuShow, 'flex': menuShow}"
            class="md:flex md:flex-grow items-center"
          >
            <ul
              id="main-menu"
              class="flex flex-col md:flex-row list-none"
            >
              <li
                v-for="menuItem in menuItems"
                class="nav-item fade-in"
              >
                <a
                  class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75"
                  :href="menuItem.url_path"
                >
                  {{ menuItem.name }}
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: 'main-menu',
  props: {
    menuItems: {
      type: Array,
      required: true,
    }
  },
  data() {
    return {
      menuShow: false,
    }
  },
  methods: {
    toggleNavbar: function () {
      this.menuShow = !this.menuShow
    },
  },
}
</script>

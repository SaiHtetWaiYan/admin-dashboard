<template>
  <div class="flex items-center">
    <div class="flex w-full bg-white shadow rounded-md">
      <dropdown :auto-close="false" class="px-4 md:px-6 rounded-md border-r hover:bg-gray-100 focus:border-white focus:outline-none  focus:z-10" placement="bottom-start">
        <div class="flex items-baseline">
          <span class="text-gray-700 hidden md:inline">Filter</span>
          <svg class="w-2 h-2 fill-gray-700 md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
            <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
          </svg>
        </div>
        <div slot="dropdown" class="mt-2 px-4 py-6 w-screen shadow-xl bg-white rounded-md" :style="{ maxWidth: `${maxWidth}px` }">
          <slot />
        </div>
      </dropdown>
      <input class="relative w-full px-6 py-3 rounded-md border-transparent" autocomplete="off" type="text" name="search" placeholder="Search…" :value="value" @input="$emit('input', $event.target.value)" />
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" class="ml-3 h-6 w-6 rotate" fill="none" type="button" viewBox="0 0 24 24" stroke="red" @click="$emit('reset')">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
  </div>
</template>

<script>
import Dropdown from '@/Shared/Dropdown'

export default {
  components: {
    Dropdown,
  },
  props: {
    value: String,
    maxWidth: {
      type: Number,
      default: 300,
    },
  },
}
</script>

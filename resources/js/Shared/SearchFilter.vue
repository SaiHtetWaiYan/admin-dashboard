<template>
  <div class="flex items-center">
    <input class="relative w-full px-6 py-2 rounded-md border-transparent shadow" autocomplete="off" type="text" name="search" placeholder="Search…" :value="value" @input="$emit('input', $event.target.value)" />
    <svg xmlns="http://www.w3.org/2000/svg" class="ml-3 mr-2 h-6 w-6 rotate" fill="none" type="button" viewBox="0 0 24 24" stroke="red" @click="$emit('reset')">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
  </div>
</template>
<script>
export default {
  components: {
   
  },
  props: {
    value: String,
  
  },
}
</script>

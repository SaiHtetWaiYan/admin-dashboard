<template>
  <div v-if="datas.links.length > 3">
    <div class="flex justify-center mb-4">
      <p class="text-sm">Showing {{datas.from}} to {{datas.to}} of {{datas.total}} results</p>
    </div>  
    <div class="flex justify-center ">
      
      <template v-for="(link, key) in datas.links">
        <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
        <inertia-link v-else :key="key" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded-full hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
      </template>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    datas: Object,
  },
}
</script>

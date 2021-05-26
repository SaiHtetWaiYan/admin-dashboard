<template>
  <div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" @click="toggleModal = !toggleModal">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
    </svg>
    <div class="flex items-center justify-center fixed left-0 bottom-0 h-screen w-screen overflow-x-hidden overflow-y-auto inset-0 z-50" v-if="toggleModal">
      <div class="bg-white rounded-lg w-full sm:w-1/4 mx-4">
        <div class="p-4 flex space-x-4 md:flex-row flex-col md:text-left text-center items-center">
          <div class="bg-red-50 p-3 md:self-start rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-red-700" width="24" height="24" viewBox="0 0 24 24"><path d="M12 5.177l8.631 15.823h-17.262l8.631-15.823zm0-4.177l-12 22h24l-12-22zm-1 9h2v6h-2v-6zm1 9.75c-.689 0-1.25-.56-1.25-1.25s.561-1.25 1.25-1.25 1.25.56 1.25 1.25-.561 1.25-1.25 1.25z" /></svg>
          </div>
          <div>
            <h1 class="text-xl font-semibold tracking-wide text-red-700">Delete</h1>
            <p class="text-gray-500">
              {{ text }}
            </p>
          </div>
        </div>
        <div class="p-3 bg-gray-50 text-right md:space-x-4 md:block flex flex-col-reverse">
          <button @click="toggleModal = false" class="px-4 md:py-1.5 py-2 bg-white border-2 rounded-lg focus:ring-offset-2 focus:outline-none hover:bg-gray-50">Cancel</button>
          <button @click="$emit('destory_id', id)" class="mb-2 md:mb-0 px-4 md:py-1.5 py-2 bg-red-700 text-white rounded-lg focus:ring-offset-2 focus:outline-none hover:bg-red-800">Confirm</button>
        </div>
      </div>
    </div>
    <div class="absolute inset-0 z-40 opacity-25 bg-black" v-if="toggleModal"></div>
  </div>
</template>

<script>
export default {
  props: {
    id: Number,
    text: String,
  },
  data() {
    return {
      toggleModal: false,
    }
  },
}
</script>

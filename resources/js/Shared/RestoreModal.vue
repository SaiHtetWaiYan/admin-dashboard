<template>
<div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" @click="toggleModal = !toggleModal">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
    </svg>

  <div class="flex items-center justify-center fixed left-0 bottom-0 h-screen w-screen overflow-x-hidden overflow-y-auto inset-0 z-50" v-if="toggleModal">
      <div class="bg-white rounded-lg w-full sm:w-1/4 mx-4">
      <div class="p-4 flex space-x-4 md:flex-row flex-col md:text-left text-center items-center">
                <div class="bg-yellow-50 p-3 md:self-start rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-yellow-500" width="24" height="24" viewBox="0 0 24 24"><path d="M12 5.177l8.631 15.823h-17.262l8.631-15.823zm0-4.177l-12 22h24l-12-22zm-1 9h2v6h-2v-6zm1 9.75c-.689 0-1.25-.56-1.25-1.25s.561-1.25 1.25-1.25 1.25.56 1.25 1.25-.561 1.25-1.25 1.25z"/></svg>
                </div>
                <div>
                    <h1 class="text-xl font-semibold tracking-wide text-yellow-500">
                        Restore
                    </h1>
                    <p class="text-gray-500">
                        Are you sure you want to restore ?
                    </p>
                </div>
            </div>
            <div class="p-3 bg-gray-50 text-right md:space-x-4 md:block flex flex-col-reverse">
                <button @click="toggleModal=false" class="px-4 md:py-1.5 py-2 bg-white border-2 rounded-lg focus:ring-offset-2 focus:outline-none hover:bg-gray-50">
                    Cancel
                </button>
                <button @click="$emit('restore_id', id)" class="mb-2 md:mb-0 px-4 md:py-1.5 py-2 bg-yellow-500 text-white rounded-lg focus:ring-offset-2 focus:outline-none  hover:bg-yellow-600">
                   Confirm
                </button>
            </div>
      </div>     
    </div>
    <div class="absolute inset-0 z-40 opacity-25 bg-black" v-if="toggleModal"></div>
</div>    
</template>

<script>
export default {
  props: {
    id: Number
  },
  data(){
      return{
          toggleModal: false,
      }
  },
}
</script>

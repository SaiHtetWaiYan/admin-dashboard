<template>
  <div class="inline-flex max-w-sm w-full bg-white shadow-md rounded-lg overflow-hidden">
    <div class="flex justify-center items-center w-12 bg-yellow-500">
      <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path></svg>
    </div>
    <div class="-mx-3 py-2 px-4 w-full">
      <div class="mx-3">
        <span class="text-yellow-500 font-semibold ">Warning</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right rotate" fill="none" viewBox="0 0 24 24" stroke="#f59e0b" type="button" @click="$emit('restore')">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
        
        <p class="text-gray-600 text-sm"><slot /></p>
      </div>
    </div>
  </div>
</template>

<script>


export default {
 
}
</script>

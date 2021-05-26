<template>
  <div class="container mx-auto px-6 pt-8 pb-4">
   
    <div v-if="$page.props.flash.success && show" class="inline-flex max-w-sm w-full bg-white shadow-md rounded-lg overflow-hidden ml-3 float-right">
      <div class="flex justify-center items-center w-12 bg-green-500">
        <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"></path></svg>
      </div>
      <div class="-mx-3 py-2 px-4 w-full">
        <div class="mx-3">
          <span class="text-green-500 font-semibold">Success</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right rotate" fill="none" viewBox="0 0 24 24" stroke="#10b981" type="button" @click="show = false">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
          <p class="text-gray-600 text-sm">{{ $page.props.flash.success }}</p>
          
        </div>
      </div>
    </div>
    <div v-if="($page.props.flash.error || Object.keys($page.props.errors).length > 0) && show" class="inline-flex max-w-sm w-full bg-white shadow-md rounded-lg overflow-hidden ml-3 float-right">
      <div class="flex justify-center items-center w-12 bg-red-500">
        <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"></path></svg>
      </div>
      <div class="-mx-3 py-2 px-4 w-full">
        <div class="mx-3">
          <span class="text-red-500 font-semibold">Error</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right rotate" fill="none" viewBox="0 0 24 24" stroke="#ef4444" type="button" @click="show = false">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
          <div v-if="$page.props.flash.error">
            <p class="text-gray-600 text-sm">{{ $page.props.flash.error }}</p>
          </div>
          <div v-else>
          <p class="text-gray-600 text-sm" v-if="Object.keys($page.props.errors).length === 1" >There is one form error.</p>
          <p class="text-gray-600 text-sm" v-else>There are {{ Object.keys($page.props.errors).length }} form errors.</p>
          </div>
        </div>
      </div>
    </div>


  </div>
</template>

<script>
export default {
  data() {
    return {
      show: true,
    }
  },
  watch: {
    '$page.props.flash': {
      handler() {
        this.show = true
      },
      deep: true,
    },
  },
}
</script>

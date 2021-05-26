<template>
  <div>
    <button class="px-6 py-3 rounded bg-blue-600 text-white text-sm leading-4 font-bold whitespace-nowrap hover:shadow-lg hover:bg-blue-800 focus:outline-none" @click="toggleModal = !toggleModal">
      <span>Create</span>
      <span class="hidden md:inline">Role</span>
    </button>
    <div class="flex items-center justify-center fixed left-0 bottom-0 h-screen w-screen overflow-x-hidden overflow-y-scroll inset-0 z-50" v-if="toggleModal">
      <div class=" w-full sm:w-1/2 mx-4">
      <form @submit.prevent="store">
        <div class="p-8 flex flex-wrap bg-white rounded-lg">
            <div class="pr-6 pb-8 w-full">
            <label :class="form.errors.name ? 'text-red-500' : 'text-gray-700' " for="name">Name</label>
              <input class="w-full mt-2 rounded-md focus:border-blue-600 " :class="form.errors.name ? 'border-red-500' : '' "  type="text" v-model="form.name" />
              <span v-if="form.errors.name"  class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1">
                {{form.errors.name}} !
              </span>
            </div>
          <strong class="w-full pb-4" :class="form.errors.permissions ? 'text-red-500' : 'text-gray-700' " for="permission">Permission:</strong>   
          <label class="inline-flex items-center w-1/3 pb-3" v-for="permission in permissions" :key="permission.id">
              <input type="checkbox" class="form-checkbox h-5 w-5" :class="form.errors.permissions ? 'border-red-500' : '' " v-model="form.permissions" :id="permission.id" :value="permission.name" ><span class="ml-2">{{permission.name}}</span>
          </label>
          <span v-if="form.errors.permissions"  class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1">
                {{form.errors.permissions}} !
          </span>
             <div class="pr-6 flex w-full items-center justify-center">
            <button @click="toggleModal = false ; clear()" type="button" class="w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 mr-4 focus:outline-none">Cancel</button>
            <button class="w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 focus:outline-none">Create</button>
             </div>
        </div>
      
      </form>  
      </div>
    </div>
    <div class="absolute inset-0 z-40 opacity-25 bg-black" v-if="toggleModal"></div>
  </div>
</template>

<script>
import FileInput from '@/Shared/FileInput'
export default {
  components: {
    FileInput
     
  },
  props: {
    errors: Object,
    permissions: Array
  },
  data() {
    return {
      toggleModal: false,
      form: this.$inertia.form({
        name: null,
        permissions : []
      }),
    }
  },
  methods: {
    store() {
      this.form.post(this.route('roles.store'), {
        onSuccess: () => {
          this.toggleModal = false,
          this.form.reset('name','permissions')
        }
      })
    },
    clear(){
      this.form.reset('name','permissions')
      this.form.clearErrors()
    }
  },
}
</script>

<template>
  <div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 hover:text-indigo-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" @click="toggleModal = !toggleModal ; checked()">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
    </svg>
    <div class="flex items-center justify-center fixed left-0 bottom-0 h-screen w-screen overflow-x-hidden overflow-y-scroll inset-0 z-50" v-if="toggleModal">
      <div class="w-full sm:w-1/2 mx-4">
        <form @submit.prevent="update">
          <div class="p-8 flex flex-wrap bg-white rounded-lg">
            <div class="pr-6 pb-8 w-full">
              <label :class="form.errors.name ? 'text-red-500' : 'text-gray-700'" for="name">Name</label>
              <input class="w-full mt-2 rounded-md focus:border-blue-600" :class="form.errors.name ? 'border-red-500' : ''" type="text" v-model="form.name" />
              <span v-if="form.errors.name" class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1"> {{ form.errors.name }} ! </span>
            </div>
            <strong class="w-full pb-4" :class="form.errors.permissions ? 'text-red-500' : 'text-gray-700'" for="permission">Permission:</strong>
            <label class="inline-flex items-center w-1/3 pb-3" v-for="permission in allpermissions" :key="permission.id">
             
              <input type="checkbox" class="form-checkbox h-5 w-5" :class="form.errors.permissions ? 'border-red-500' : ''" v-model="form.permissions"  :value="permission.id"><span class="ml-2">{{ permission.name }}</span>
              
            </label>
            <span v-if="form.errors.permissions" class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1"> {{ form.errors.permissions }} ! </span>
            <div class="pr-6 flex w-full items-center justify-center">
              <button
                @click="
                  toggleModal = false ;
                  clear()
                "
                type="button"
                class="w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 mr-4 focus:outline-none"
              >
                Cancel
              </button>
              <button class="w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 focus:outline-none">Update</button>
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
    FileInput,
  },
  props: {
    errors: Object,
    allpermissions: Array,
    role: Object,
  },
  
  data() {
    return {
      toggleModal: false,
      form: this.$inertia.form({
        name: this.role.name,
        permissions: null
      }),
    }
  },
  methods: {
    update() {
      this.form.put(this.route('roles.update', this.role.id), {
        onSuccess: () => {
          this.$emit('reload'),
          this.toggleModal = false,
          this.form.reset('name','permissions')  
        }
      })
    },
    clear() {
      this.form.reset('name', 'permissions')
      this.form.clearErrors()
    },
    checked() {
        var arr = [];
        var len = this.role.permissions.length;
        for (var i = 0; i < len; i++) {
            arr.push(
                this.role.permissions[i].id,
            );
        }
        this.form.permissions = arr;
    }
  },

}
</script>

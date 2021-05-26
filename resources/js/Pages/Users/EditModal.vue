<template>
  <div>
     <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 hover:text-indigo-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" @click="toggleModal = !toggleModal">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
    </svg>
    <div class="flex items-center justify-center fixed left-0 bottom-0 h-screen w-screen overflow-x-hidden overflow-y-scroll inset-0 z-50" v-if="toggleModal">
       
      <div class=" w-full sm:w-1/2 mx-4">
      
      <form @submit.prevent="update">
        <div class="grid bg-white rounded-lg pt-5 ">
          <div class="grid grid-cols-1 overflow-hidden mx-7" v-if="user.photo">
            <img  class="inline-block h-20 w-20 rounded ring-2 ring-white" :src="user.photo">
         </div>    
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
              <label :class="form.errors.name ? 'text-red-500' : 'text-gray-700' " for="name">Name</label>
              <input class="w-full mt-2 rounded-md focus:border-blue-600 " :class="form.errors.name ? 'border-red-500' : '' "  type="text" v-model="form.name" />
              <span v-if="form.errors.name"  class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1">
                {{form.errors.name}} !
              </span>
            </div>
            <div class="grid grid-cols-1">
              <label :class="form.errors.email ? 'text-red-500' : 'text-gray-700' " for="emailAddress">Email Address</label>
              <input class="w-full mt-2 rounded-md focus:border-blue-600" type="email" :class="form.errors.email ? 'border-red-500' : ''" v-model="form.email" />
              <span v-if="form.errors.email"  class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1">
                {{form.errors.email}} !
              </span>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
              <label :class="form.errors.password ? 'text-red-500' : 'text-gray-700' " for="password">Password</label>
              <input class="w-full mt-2 rounded-md focus:border-blue-600" type="password" :class="form.errors.password ? 'border-red-500' : ''" v-model="form.password" />
              <span v-if="form.errors.password"  class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1">
                {{form.errors.password}} !
              </span>
            </div>
            <div class="grid grid-cols-1" v-if="$page.props.auth.user.permissions['user-add-role'] == 'user-add-role'">
              <label :class="form.errors.role ? 'text-red-500' : 'text-gray-700' " for="role">Role</label>
              <select v-model="form.role" class="w-full mt-2 rounded-md form-select" :class="form.errors.role ? 'border-red-500' : ''">
                <option v-for="role in roles" :key="role"   :value="role">{{ role}}</option>
              </select>
              <span v-if="form.errors.role"  class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1">
                {{form.errors.role}} !
              </span>
            </div>
          </div>

          <div class="grid grid-cols-1 mt-5 mx-7">
              <file-input v-model="form.photo" :error="form.errors.photo" class="w-full mt-2 rounded-md focus:border-blue-600" type="file" accept="image/*" label="Photo" />
          </div>

          <div class="flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5 bg-gray-100 mt-5">
            <button @click="toggleModal = false ; clear()" type="button" class="w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 focus:outline-none">Cancel</button>
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
    FileInput
     
  },
  props: {
    errors: Object,  
    user: Object,  
    roles : Object
  },
  data() {
    return {
      toggleModal: false,
      form: this.$inertia.form({
        _method: 'put',
        name: this.user.name,
        email: this.user.email,
        role: this.user.role[0],
        password: null,
        photo: null,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(this.route('users.update', this.user.id), {
        onSuccess: () => {
          this.$emit('reload'),
          this.toggleModal = false,
          this.form.reset('name','email','password','role','photo')
        }
      })
    },
    clear(){
        this.form.reset('name','email','password','role','photo')
        this.form.clearErrors()
    }
  },
}
</script>

<template>
  <div class="container mx-auto px-6 py-8">
    <div class="text-gray-700 text-xl font-medium breadcrumbs pb-4 dark:text-white">
      <ul>
        <li>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mr-2 stroke-current"><!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> 
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!---->
          </svg>
          Profile
        </li>
      </ul>
    </div>
    <div class="flex space-x-4 overflow-hidden">
    <img v-if="user.photo" class="inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-900" :src="user.photo">
    
    </div>
    <div class="mt-4">
      <div class="p-6 bg-white rounded-md shadow-md">
        <form @submit.prevent="update">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
            <div>
              <label :class="$page.props.errors.name ? 'text-red-500' : 'text-gray-700' " for="name">Name</label>
              <input class="w-full mt-2 rounded-md focus:border-blue-600 " :class="$page.props.errors.name ? 'border-red-500' : '' "  type="text" v-model="form.name" />
              <span v-if="$page.props.errors.name"  class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1">
                {{$page.props.errors.name}} !
              </span>
            </div>
            <div>
              <label :class="$page.props.errors.email ? 'text-red-500' : 'text-gray-700' " for="emailAddress">Email Address</label>
              <input class="w-full mt-2 rounded-md focus:border-blue-600" type="email" :class="$page.props.errors.email ? 'border-red-500' : ''" v-model="form.email" />
              <span v-if="$page.props.errors.email"  class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1">
                {{$page.props.errors.email}} !
              </span>
            </div>
            <div>
              <label :class="$page.props.errors.password ? 'text-red-500' : 'text-gray-700' " for="password">Password</label>
              <input class="w-full mt-2 rounded-md focus:border-blue-600" type="password" :class="$page.props.errors.password ? 'border-red-500' : ''" v-model="form.password" />
              <span v-if="$page.props.errors.password"  class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1">
                {{$page.props.errors.password}} !
              </span>
            </div>
            <div v-if="$page.props.auth.user.permissions['user-add-role'] == 'user-add-role'">
              <label :class="$page.props.errors.role ? 'text-red-500' : 'text-gray-700' " for="role">Role</label>
              <select v-model="form.role" class="w-full mt-2 rounded-md form-select" :class="$page.props.errors.role ? 'border-red-500' : ''">
                <option v-for="role in roles" :key="role"   :value="role">{{ role}}</option>
              </select>
              <span v-if="$page.props.errors.role"  class="flex items-center font-medium tracking-wide text-red-500 mt-1 ml-1">
                {{$page.props.errors.role}} !
              </span>
            </div>
            <file-input v-model="form.photo" :error="form.errors.photo" class="w-full mt-2 rounded-md focus:border-blue-600" type="file" accept="image/*" label="Photo" />
          </div>
          <div class="flex justify-end">
            <inertia-link :href="route('users')" type="button" class="w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 mr-6 focus:outline-none">Cancel</inertia-link>
            <button class="w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 focus:outline-none">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import FileInput from '@/Shared/FileInput'


export default {
  metaInfo() {
    return {
      title: `${this.form.name}`,
    }
  },
  components: {
    FileInput,
  },
  layout: Layout,
  props: {
    user: Object,
    roles: Object
  },
  remember: 'form',
  data() {
    return {
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
        onSuccess: () => this.form.reset('password', 'photo'),
      })
    },
    
  },
}
</script>

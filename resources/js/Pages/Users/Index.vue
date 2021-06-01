<template>
  <div class="container mx-auto px-6 py-8">
    
    <div class="text-gray-700 text-xl font-medium breadcrumbs dark:text-white">
      <ul>
        <li>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mr-2 stroke-current"><!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> 
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!---->
          </svg>
          Users
        </li> 
      </ul>
    </div>
    <div class="mt-4">
      <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center">
        <button class="px-6 py-3 mr-4 rounded bg-gray-600 text-white text-sm leading-4 font-bold whitespace-nowrap hover:shadow-lg hover:bg-gray-800 focus:outline-none inline-flex" v-on:click="filterbox = !filterbox">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" v-if="filterbox === false">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor" v-else>
            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
          </svg>
          <span class="hidden md:inline">Filters</span>
        </button>
        <search-filter v-model="form.search" @reset="reset"></search-filter>
        </div>
        <div class="flex items-center">
        <CreateModal :roles="roles" v-if="$page.props.auth.user.permissions['user-create'] == 'user-create'" class="flex justify-end"></CreateModal>
        </div>
      </div>
      <div v-if="filterbox" class="p-6 bg-white rounded-md shadow-md">
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
          <div>
            <label class="block text-gray-700">Role</label>
            <select v-model="form.role" class="mt-1 w-full form-select rounded-md">
              <option :value="null" />
              <option v-for="role in roles" :key="role"   :value="role">{{ role}}</option>
            </select>
          </div>
          <div>
            <label class="block text-gray-700">Trashed</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select rounded-md">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option> 
            </select>
          </div>
          <div v-if="$page.props.auth.user.permissions['user-export'] == 'user-export'">
            <label class="block text-gray-700">Export</label>
            <select class="mt-1 w-full form-select rounded-md" @change="onChange($event)">
              <option :value="null" />
              <option value="one">Only One Page</option>
              <option value="all">All Pages</option> 
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col mt-8">
      <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
          <table class="min-w-full">
            <thead>
              <tr>
                <th scope="col" class="w-3/12 text-xs font-semibold tracking-wider text-left border-b  border-gray-200 bg-red-500 text-white uppercase">
                        <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('name')">Name

                        <svg v-if="form.field === 'name' && form.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                        </svg>

                        <svg v-if="form.field === 'name' && form.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                        </svg>
                        </span>
                </th>
                <th scope="col" class="w-3/12 text-xs font-semibold tracking-wider text-left border-b border-gray-200 bg-red-500 text-white uppercase">
                        <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('email')">Email

                        <svg v-if="form.field === 'email' && form.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                        </svg>

                        <svg v-if="form.field === 'email' && form.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                        </svg>
                        </span>
                </th>
                <th scope="col" class="w-3/12 text-xs font-semibold tracking-wider text-left border-b border-gray-200 bg-red-500 text-white uppercase">
                        <span class="inline-flex py-3 px-6 w-full justify-between" >Role
                        </span>
                </th>
                <th scope="col" class="w-3/12 border-b border-gray-200 bg-red-500  tracking-wider">
                </th>
              </tr>
            </thead>

            <tbody class="bg-white">
              <tr v-for="user in users.data" :key="user.id">
                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <img v-if="user.photo" class="h-10 w-10 rounded-full" :src="user.photo" alt="" />
                      <avatar v-else :username="user.name" :size="40" background-color="#9e9e9e" color="#fff"></avatar> 
                    </div>

                    <div class="ml-4">
                      <div class="text-sm leading-5 font-medium text-gray-900">{{ user.name }}</div>
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" v-if="user.deleted_at">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900">{{ user.email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900" v-if="user.role">{{ user.role[0] }}</div>
                </td>
                <td class="px-6 py-4 border-b border-gray-200  leading-5 ">
                  <div class="flex justify-center">
                    <EditModal :roles="roles" :user="user" v-if="$page.props.auth.user.permissions['user-edit'] == 'user-edit'" :key="reload" @reload="reload_count"></EditModal>
                    
                    <EditModal :roles="roles" :user="user" v-else-if="$page.props.auth.user.permissions['user-own-edit'] == 'user-own-edit' && $page.props.auth.user.id == user.id"></EditModal>
                  <div v-if="$page.props.auth.user.permissions['user-delete'] == 'user-delete'">
                  <div  v-if="user.deleted_at">
                    <RestoreModal :id="user.id" @restore_id="restore"></RestoreModal>
                  </div>
                  <div  v-else>
                    <DeleteModal :id="user.id" :text="'Are you sure want to delete this user ( '+ user.name +' ) ?'" @destory_id="destory"></DeleteModal>
                  </div>
                  </div>
                  </div>
                </td>
               
              </tr>
              <tr v-if="users.data.length === 0">
               <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200" colspan="4">No users found.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      <pagination class="mt-6" :datas="users" />
    </div>

  </div>
</template>

<script>
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import SearchFilter from '@/Shared/SearchFilter'
import Pagination from '@/Shared/Pagination'
import Avatar from 'vue-avatar'
import CreateModal from '@/Pages/Users/CreateModal'
import EditModal from '@/Pages/Users/EditModal'
import DeleteModal from '@/Shared/DeleteModal'
import RestoreModal from '@/Shared/RestoreModal'

export default {
  metaInfo: { title: 'Users' },
  components: {
    SearchFilter,
    Pagination,
    Avatar,
    CreateModal,
    EditModal,
    DeleteModal,
    RestoreModal
  },
  layout: Layout,
  props: {
    users: Object,
    roles: Object,
    filters: Object,
    users_id: Array
  },
  data() {
    return {
      filterbox: false,
      reload: 0,
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
        field: this.filters.field,
        direction: this.filters.direction,
      }
    }
  },
  watch: {
    form: {
      handler: throttle(function () {
        let query = pickBy(this.form)
        this.$inertia.get(this.route('users', Object.keys(query).length ? query : { remember: 'forget' }), {}, { preserveState: true })
      }, 150),
      deep: true,
      
    },
  },
  methods: {
    reload_count(){
      this.reload++
    },
    reset() {
      this.form = mapValues(this.form, () => null)
      
    },
    sort(field) {
      this.form.field = field;
      this.form.direction = this.form.direction === 'asc' ? 'desc' : 'asc';
    },
    destory(value){
      this.$inertia.delete(this.route('users.destroy', value))
    },
    restore(value){
      this.$inertia.put(this.route('users.restore', value))
    },
    fetchData(){
      return this.users.data;
    },
    onChange(event){

      if(event.target.value === "one")
      {
        var arr = [];
        var len = this.users.data.length;
        for (var i = 0; i < len; i++) {
            arr.push(
                this.users.data[i].id
            );
        }
       
        window.open(route('users.export',{user: arr}), "_blank");    
    
      }
      if(event.target.value === "all")
      {
        
        var arr = this.users_id.map(({ id }) => id)
        window.open(route('users.export',{user: arr}), "_blank");    
      }
      
    }
  },
}
</script>

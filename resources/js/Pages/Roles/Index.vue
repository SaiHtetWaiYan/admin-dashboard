<template>
  <div class="container mx-auto px-6 py-8">
    
    <div class="text-gray-700 text-xl font-medium breadcrumbs dark:text-white">
      <ul>
        <li>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mr-2 stroke-current"><!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> 
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!---->
          </svg>
         Roles
        </li> 
      </ul>
    </div>
    <div class="mt-4">
      <div class="mb-6 flex justify-end">
         <CreateModal :permissions="permissions" v-if="$page.props.auth.user.permissions['role-create'] == 'role-create'"></CreateModal>
      </div>
    </div>

    <div class="flex flex-col mt-8">
      <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
          <table class="min-w-full">
            <thead>
              <tr>
                <th scope="col" class="w-3/12 text-xs font-semibold tracking-wider text-left border-b border-gray-200 bg-red-500 text-white uppercase">
                    <span class="inline-flex py-3 px-6 w-full justify-between">Id</span>
                </th>
                <th scope="col" class="w-3/12 text-xs font-semibold tracking-wider text-left border-b border-gray-200 bg-red-500 text-white uppercase">
                    <span class="inline-flex py-3 px-6 w-full justify-between">Name</span>
                </th>
                <th scope="col" class="w-3/12 text-xs font-semibold tracking-wider text-left border-b border-gray-200 bg-red-500 text-white uppercase">
                    <span class="inline-flex py-3 px-6 w-full justify-between">Number of Permission</span>
                </th>
                <th scope="col" class="w-3/12 border-b border-gray-200 bg-red-500 text-white tracking-wider">
                </th>
              </tr>
            </thead>

            <tbody class="bg-white">
              <tr v-for="role in roles" :key="role.id">
                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900">{{ role.id }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900">{{ role.name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900">{{ role.permissions.length }}</div>
                </td>
                <td class="px-6 py-4 border-b border-gray-200  leading-5 ">
                  <div class="flex justify-center">
                  <EditModal :role="role" :allpermissions="permissions" :key="reload" @reload="reload_count" v-if="$page.props.auth.user.permissions['role-edit'] == 'role-edit'"></EditModal>  
                  <DeleteModal :id="role.id" :text="'Are you sure you want to delete this role ( '+ role.name +' ) ? All of your data will be permanently removed. This action cannot be undone.'" @destory_id="destory" v-if="$page.props.auth.user.permissions['role-delete'] == 'role-delete'"></DeleteModal>
                  </div>
                </td>
               
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
     
    </div>
  </div>
  
</template>

<script>
import Layout from '@/Shared/Layout'
import CreateModal from '@/Pages/Roles/CreateModal'
import EditModal from '@/Pages/Roles/EditModal'
import DeleteModal from '@/Shared/DeleteModal'

export default {
  metaInfo: { title: 'Roles' },
  components: {
   CreateModal,
   EditModal, 
   DeleteModal
  },
  layout: Layout,
  props: {
    roles: Array,
    permissions: Array
  },
  data() {
    return {
      reload: 0,
    }
  },
  methods:{
    reload_count(){
      this.reload++
    },
    destory(value){
      this.$inertia.delete(this.route('roles.destroy', value))
    },
  }
  
}
</script>

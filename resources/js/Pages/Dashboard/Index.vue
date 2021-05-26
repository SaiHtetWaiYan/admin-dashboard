<template>
  <div class="container mx-auto px-6 py-8">
      <div class="text-gray-700 text-xl font-medium breadcrumbs dark:text-white">
      <ul>
        <li>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mr-2 stroke-current"><!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> 
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!----> <!---->
          </svg>
         Dashboard
        </li> 
      </ul>
    </div>
        <div class="flex flex-col lg:flex-row w-full lg:space-x-2 space-y-2 lg:space-y-0 mt-4">
            <div class="w-full lg:w-1/4">
                <div class="widget w-full p-4 rounded-lg bg-white border border-gray-100 dark:bg-gray-800 dark:border-gray-700 shadow">
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-col">
                            <div class="text-xs uppercase font-light text-gray-500 dark:text-white">
                                Users
                            </div>
                            <div class="text-xl font-bold dark:text-white">
                                {{user}}
                            </div>
                        </div>
                        <svg class="stroke-current text-gray-500 dark:text-white" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2">
                            </path>
                            <circle cx="9" cy="7" r="4">
                            </circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87">
                            </path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/4" v-if="$page.props.auth.user.permissions['role-list'] == 'role-list'">
                <div class="widget w-full p-4 rounded-lg bg-white border border-gray-100 dark:bg-gray-800 dark:border-gray-700 shadow">
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-col">
                            <div class="text-xs uppercase font-light text-gray-500 dark:text-white">
                                Roles
                            </div>
                            <div class="text-xl font-bold dark:text-white">
                                {{role}}
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 dark:text-white" height="24" width="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  metaInfo: { title: 'Dashboard' },
  layout: Layout,
  props: {
    role: Number,
    user: Number
  },
}
</script>

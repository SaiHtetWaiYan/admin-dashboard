<template>
  <div>
    <nav class="mt-10">

      <inertia-link class="flex items-center py-2 px-8 " :class="isUrl('') ? 'bg-gray-100 dark:bg-gray-700 dark:text-white text-gray-700 border-r-4 border-red-600' : 'text-gray-600 dark:text-white border-r-4 border-white dark:border-gray-900 dark:hover:border-red-600 dark:hover:bg-gray-700 hover:bg-gray-100  hover:text-gray-700 hover:border-red-600'" :href="route('dashboard')">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="mx-4 font-medium">Dashboard</span>
      </inertia-link>
      <inertia-link class="flex items-center mt-5 py-2 px-8 " :class="isUrl('users') ? 'bg-gray-100 dark:bg-gray-700 dark:text-white text-gray-700 border-r-4 border-red-600' : 'text-gray-600 dark:text-white border-r-4 border-white dark:border-gray-900 dark:hover:border-red-600 dark:hover:bg-gray-700 hover:bg-gray-100 hover:text-gray-700 hover:border-red-600'" :href="route('users')" v-if="$page.props.auth.user.permissions['user-list'] == 'user-list'">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="mx-4 font-medium">Users</span>
      </inertia-link> 
      <inertia-link class="flex items-center mt-5 py-2 px-8 " :class="isUrl('roles') ? 'bg-gray-100 dark:bg-gray-700 dark:text-white text-gray-700 border-r-4 border-red-600' : 'text-gray-600 dark:text-white border-r-4 border-white dark:border-gray-900 dark:hover:border-red-600 dark:hover:bg-gray-700 hover:bg-gray-100 hover:text-gray-700 hover:border-red-600'" :href="route('roles')" v-if="$page.props.auth.user.permissions['role-list'] == 'role-list'">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
        <span class="mx-4 font-medium">Roles</span>
      </inertia-link> 
    </nav>
  </div>
</template>

<script>
export default {
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter(url => currentUrl.startsWith(url)).length
    },
  },
}
</script>

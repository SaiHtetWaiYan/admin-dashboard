<template>
  <svg v-if="theme === 'light'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" @click.prevent="switchTheme">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
  </svg>

  <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-4 text-gray-200" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" @click.prevent="switchTheme">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
  </svg>
</template>

<script>
export default {
  data() {
    return {
      theme: '',
    }
  },
  mounted() {
    const userPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
    const defaultTheme = userPrefersDark ? 'dark' : 'light'
    const theme = localStorage.getItem('theme') || defaultTheme
    this.setTheme(theme)
  },
  methods: {
    switchTheme() {
      const newTheme = this.theme === 'light' ? 'dark' : 'light'
      this.setTheme(newTheme)
    },
    setTheme(newTheme) {
      this.theme = newTheme
      if (this.theme === 'dark') {
        document.documentElement.classList.add('dark')
      } else {
        document.documentElement.classList.remove('dark')
      }
      localStorage.setItem('theme', newTheme)
    },
  },
}
</script>

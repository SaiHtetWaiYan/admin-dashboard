<template>
  <div class="bg-gray-50 dark:bg-gray-800 min-h-screen flex flex-col">
    <div class="flex justify-end pt-6 mr-6">
      <SwitchTheme></SwitchTheme>
    </div>
    <div class="container max-w-lg mx-auto flex-1 flex flex-col items-center justify-center sm:-mt-20 px-4">
      <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full border-r-4 border-red-600">
        <div v-if="$page.props.flash.error" class="text-center text-sm  text-red-600 pb-4"> 
          <span >{{ $page.props.flash.error }}</span>
        </div>
        
        <h1 class="mb-8 text-3xl text-center" :class="form.errors.email || form.errors.password ? 'wrong' : ''">
          <svg version="1.0" xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 inline-flex" viewBox="0 0 100.000000 100.000000" preserveAspectRatio="xMidYMid meet">
              <g transform="translate(0.000000,100.000000) scale(0.100000,-0.100000)" fill="#ef4444" stroke="#ef4444">
                <path d="M390 990 c-73 -16 -165 -67 -209 -116 -69 -79 -95 -202 -69 -326 8 -37 11 -73 6 -80 -21 -33 5 -111 41 -123 12 -3 21 -19 25 -39 18 -97 119 -231 209 -278 59 -31 156 -31 215 0 84 45 170 152 198 249 9 32 28 65 50 87 34 34 42 63 25 94 -5 11 -4 42 5 82 38 180 -6 303 -124 346 -26 10 -60 30 -77 45 -16 14 -45 34 -64 44 -40 20 -166 28 -231 15z m338 -372 c13 -25 26 -74 30 -108 7 -66 26 -89 40 -50 8 21 8 21 31 2 32 -25 22 -69 -18 -85 -23 -8 -30 -18 -34 -48 -18 -136 -165 -289 -277 -289 -51 0 -131 43 -180 96 -48 52 -100 155 -100 199 0 24 -7 33 -33 45 -41 19 -49 61 -15 84 22 16 23 15 28 -6 10 -41 34 -27 41 23 13 86 38 107 176 148 77 23 125 56 149 102 l15 29 62 -48 c41 -31 70 -63 85 -94z" />
                <path d="M468 515 c-4 -4 -42 -11 -85 -15 -66 -7 -80 -12 -100 -34 -39 -46 -21 -121 37 -151 37 -19 63 -19 100 0 50 26 67 76 49 145 -3 11 5 15 31 15 26 0 34 -4 31 -15 -18 -69 -1 -119 49 -145 37 -19 63 -19 100 0 58 30 76 105 37 151 -19 22 -35 28 -97 35 -41 5 -91 12 -110 15 -19 3 -38 2 -42 -1z" />
              </g>
            </svg>
        </h1>
        
        <form  @submit.prevent="submit" class="text-center">
        <span class="text-red-500 text-sm " v-if="form.errors.email">{{form.errors.email}}</span>
        <input  class="block border w-full p-3 rounded text-center mb-4" :class="form.errors.email ? 'border-red-500 mt-3' : ''" v-model="form.email" type="text" name="email" id="email" placeholder="Enter Email Address...." />
        
        <span class="text-red-500 text-sm " v-if="form.errors.password">{{form.errors.password}}</span>
        <input class="block border w-full p-3 rounded text-center mb-4" :class="form.errors.password ? 'border-red-500 mt-3' : ''" v-model="form.password" type="password" name="password" id="password" placeholder="New Password" />
        
        <span class="text-red-500 text-sm " v-if="form.errors.password_confirmation">{{form.errors.password_confirmation}}</span>
        <input class="block border w-full p-3 rounded text-center mb-4" :class="form.errors.password_confirmation ? 'border-red-500 mt-3' : ''" v-model="form.password_confirmation" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm New Password" />
        

        <button type="submit" class="w-full uppercase text-center py-3 rounded bg-green text-white bg-red-500 hover:bg-red-600 focus:outline-none my-1 mb-4">Reset Password</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import SwitchTheme from '@/Shared/SwitchTheme'
export default {
  metaInfo: { title: 'Forgot Password' },
  components: {
    SwitchTheme
  },
  props: {
    errors: Object,
    token: String
  },
  data() {
    return {
      form: this.$inertia.form({
        email: null,
        password: null,
        password_confirmation: null,
        token: this.token
      }),
    }
  },
  methods: {
    submit() {
      this.form.post(this.route('resetpassword.attempt'))
    },
  },
}
</script>

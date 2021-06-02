import Vue from 'vue'
import VueMeta from 'vue-meta'
import PortalVue from 'portal-vue'
import { App, plugin } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress/src'
import VCalendar from 'v-calendar'

Vue.config.productionTip = false
Vue.config.devtools = false
Vue.config.silent = true

Vue.mixin({ methods: { route: window.route } })
Vue.use(plugin)
Vue.use(PortalVue)
Vue.use(VueMeta)
Vue.use(require('vue-moment'));
Vue.use(VCalendar, {
  componentPrefix: 'vc', 
})
InertiaProgress.init({
 
  delay: 250,

  color: '#dc2626',

  includeCSS: true,

  showSpinner: false,
})

const el = document.getElementById('app')

new Vue({
  metaInfo: {
    titleTemplate: title => (title ? `${title} - Admin Dashboard` : 'Admin Dashboard'),
  },
  render: h =>
    h(App, {
      props: {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
      },
    }),
}).$mount(el)

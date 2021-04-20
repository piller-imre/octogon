import Vue from 'vue'
import Router from 'vue-router'

import Archive from '@/components/Archive'
import Contacts from '@/components/Contacts'
import EditorialBoard from '@/components/EditorialBoard'
import Home from '@/components/Home'
import Rules from '@/components/Rules'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/home',
      name: 'Home',
      component: Home
    },
    {
      path: '/archive',
      name: 'Archive',
      component: Archive
    },
    {
      path: '/rules',
      name: 'Rules',
      component: Rules
    },
    {
      path: '/editorial-board',
      name: 'EditorialBoard',
      component: EditorialBoard
    },
    {
      path: '/contacts',
      name: 'Contacts',
      component: Contacts
    }
  ]
})


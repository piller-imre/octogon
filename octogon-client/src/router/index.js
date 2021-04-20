import Vue from 'vue'
import Router from 'vue-router'

import Login from '@/components/Login'

import Archive from '@/components/public/Archive'
import Contacts from '@/components/public/Contacts'
import EditorialBoard from '@/components/public/EditorialBoard'
import Home from '@/components/public/Home'
import Rules from '@/components/public/Rules'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
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


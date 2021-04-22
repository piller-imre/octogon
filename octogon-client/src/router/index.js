import Vue from 'vue'
import Router from 'vue-router'

import Login from '@/components/Login'

import Archive from '@/components/public/Archive'
import Contacts from '@/components/public/Contacts'
import EditorialBoard from '@/components/public/EditorialBoard'
import Home from '@/components/public/Home'
import Rules from '@/components/public/Rules'

import ArticleData from '@/components/admin/ArticleData'
import ArticleTitleData from '@/components/admin/ArticleTitleData'
import ArticleTypeData from '@/components/admin/ArticleTypeData'
import ArticleTypeList from '@/components/admin/ArticleTypeList'
import AuthorshipData from '@/components/admin/AuthorshipData'
import ContributorData from '@/components/admin/ContributorData'
import ContributorList from '@/components/admin/ContributorList'
import EditorialBoardData from '@/components/admin/EditorialBoardData'
import VolumeContent from '@/components/admin/VolumeContent'
import VolumeData from '@/components/admin/VolumeData'
import VolumeList from '@/components/admin/VolumeList'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    // public pages
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
    },
    // admin pages
    {
      path: '/article-data',
      name: 'ArticleData',
      component: ArticleData
    },
    {
      path: '/article-title-data',
      name: 'ArticleTitleData',
      component: ArticleTitleData
    },
    {
      path: '/article-type-data',
      name: 'ArticleTypeData',
      component: ArticleTypeData
    },
    {
      path: '/article-type-list',
      name: 'ArticleTypeList',
      component: ArticleTypeList
    },
    {
      path: '/authorship-data',
      name: 'AuthorshipData',
      component: AuthorshipData
    },
    {
      path: '/contributor-data',
      name: 'ContributorData',
      component: ContributorData
    },
    {
      path: '/contributor-list',
      name: 'ContributorList',
      component: ContributorList
    },
    {
      path: '/editorial-board-data',
      name: 'EditorialBoardData',
      component: EditorialBoardData
    },
    {
      path: '/volume-content',
      name: 'VolumeContent',
      component: VolumeContent
    },
    {
      path: '/volume-data',
      name: 'VolumeData',
      component: VolumeData
    },
    {
      path: '/volume-list',
      name: 'VolumeList',
      component: VolumeList
    }
  ]
})


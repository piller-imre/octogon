import Vue from 'vue'
import Router from 'vue-router'

// TODO: Remove from the production version!
import Home from '@/components/Home'

import Login from '@/components/Login'

import VolumeContent from '@/components/VolumeContent'
import VolumeData from '@/components/VolumeData'
import VolumeList from '@/components/VolumeList'
import ArticleData from '@/components/ArticleData'
import ArticleTitleData from '@/components/ArticleTitleData'
import ArticleTypeData from '@/components/ArticleTypeData'
import ArticleTypeList from '@/components/ArticleTypeList'
import AuthorshipData from '@/components/AuthorshipData'
import ContributorData from '@/components/ContributorData'
import ContributorList from '@/components/ContributorList'
import EditorialBoardData from '@/components/EditorialBoardData'
import PostData from '@/components/PostData'
import PostList from '@/components/PostList'
import RuleData from '@/components/RuleData'
import ContactData from '@/components/ContactData'
import FileList from '@/components/FileList'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
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
    },
    {
      path: '/home',
      name: 'Home',
      component: Home
    },
    {
      path: '/post-data',
      name: 'PostData',
      component: PostData
    },
    {
      path: '/post-list',
      name: 'PostList',
      component: PostList
    },
    {
      path: '/rule-data',
      name: 'RuleData',
      component: RuleData
    },
    {
      path: '/contact-data',
      name: 'ContactData',
      component: ContactData
    },
    {
      path: '/file-list',
      name: 'FileList',
      component: FileList
    },
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
  ]
})


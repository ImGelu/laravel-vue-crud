import {createRouter, createWebHistory} from 'vue-router'
import Login from '../views/Login.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Login
        },
        {
            path: '/login',
            name: 'login',
            component: () => import('../views/Login.vue')
        },
        {
            path: '/register',
            name: 'register',
            component: () => import('../views/Register.vue')
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: () => import('../views/Dashboard.vue')
        },
        {
            path: '/books',
            name: 'books',
            component: () => import('../views/books/Index.vue')
        },
        {
            path: '/books/:id',
            name: 'books-view',
            component: () => import('../views/books/View.vue')
        },
        {
            path: '/books/:id/edit',
            name: 'books-edit',
            component: () => import('../views/books/Edit.vue')
        },
        {
            path: '/books/create',
            name: 'books-create',
            component: () => import('../views/books/Create.vue')
        },
        {
            path: '/authors',
            name: 'authors',
            component: () => import('../views/authors/Index.vue')
        },
        {
            path: '/authors/:id',
            name: 'authors-view',
            component: () => import('../views/authors/View.vue')
        },
        {
            path: '/authors/:id/edit',
            name: 'authors-edit',
            component: () => import('../views/authors/Edit.vue')
        },
        {
            path: '/authors/create',
            name: 'authors-create',
            component: () => import('../views/authors/Create.vue')
        },
    ]
})

export default router

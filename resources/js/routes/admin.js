import Vue from "vue";
import Router from "vue-router";

import Dashboard from '../components/Admin/Dashboard';
import Photo from '../components/Admin/Photo';
import Video from '../components/Admin/Video';
import News from '../components/Admin/News';
import AddNews from '../components/Admin/AddNews';
import EditNews from '../components/Admin/EditNews';
import Applications from '../components/Admin/Applications';
import Schedule from '../components/Admin/Schedule';

Vue.use(Router);

let router = new Router({
    mode: 'history',
    routes: [
      {
        path: '/admin',
        name: 'Dashboard',
        component: Dashboard,
        meta: { 
          requiresAuth: true
        }
      },
      {
        path: '/dashboard/photo',
        name: 'photo',
        component: Photo,
        meta: { 
          requiresAuth: true
        }
      },
      {
        path: '/dashboard/video',
        name: 'video',
        component: Video,
        meta: { 
          requiresAuth: true
        }
      },
      {
        path: '/dashboard/news',
        name: 'news',
        component: News,
        meta: { 
          requiresAuth: true
        }
      },
      {
        path: '/dashboard/post-news',
        name: 'AddNews',
        component: AddNews,
        meta: { 
          requiresAuth: true
        }
      },
      {
        path: '/dashboard/edit-news/:id/',
        name: 'EditNews',
        component: EditNews,
        meta: { 
          requiresAuth: true
        }
      },
      {
        path: '/dashboard/applications',
        name: 'applications',
        component: Applications,
        meta: { 
          requiresAuth: true
        }
      },
      {
        path: '/dashboard/schedule',
        name: 'schedule',
        component: Schedule,
        meta: { 
          requiresAuth: true
        }
      },
    ]
})

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)) {
    if (localStorage.getItem('jwt') == null) {
      next({
        path: '/login',
        params: { nextUrl: to.fullPath }
      })
    } else {
      let user = JSON.parse(localStorage.getItem('user'))
      if(to.matched.some(record => record.meta.is_admin)) {
        if(user.is_admin == 1){
          next()
        }
        else{
          next({ name: 'register'})
        }
      }else {
        next()
      }
    }
  } else if(to.matched.some(record => record.meta.guest)) {
    if(localStorage.getItem('jwt') == null){
      next()
    }
  }else {
    next() 
  }
})

export default router;
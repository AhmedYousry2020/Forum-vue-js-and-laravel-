import Login from '../pages/auth/Login.vue'
import Register from '../pages/auth/Register.vue'
import Home from '../pages/Home.vue'
import SingleDiscussion from '../pages/SingleDiscussion.vue'
import Index from "../pages/Index.vue";
import Welcome from '../pages/Welcome.vue'
import Profile from '../pages/Profile.vue'
import EditProfile from '../pages/EditProfile.vue'
import Index2 from "../pages/Index2.vue";

import Vue from 'vue';
import  VueRouter from 'vue-router';
import guest from '../middlewares/guest'
import store from '../store/index';
import checkAuth from '../middlewares/checkAuth';
import auth from '../middlewares/auth';
import middlewarePipLine from '../routes/middlewarePipLine';

Vue.use(VueRouter)


const router = new VueRouter({

    mode:"history",
    routes:[
        {
            path:'/',
            component: Welcome,
            name: 'welcome'
        },
        {
            path:'/profile',
            component: Profile,

            meta:{
                middleware:[auth,checkAuth]
               },
               children:[
                    {
                        path:'/profile',
                        component:Index2,
                        name: 'profile',
                        meta:{
                            middleware:[auth,checkAuth]
                           },
                    },
                {
                    path:'/Edit/:id',
                component: EditProfile,
                name: 'EditProfile',
               }
               ]


        },
        {
            path:'/home',
            component: Home,
            meta:{
                middleware:[auth,checkAuth]
               },

            children: [
                {
                    path:'',
                    component:Index,
                    name: 'home',
                    meta:{
                        middleware:[auth,checkAuth]
                       },
                 },
                {
                    path:'discussion/:channel/:discussion',
                    component:SingleDiscussion,
                    name:'singlediscussion',

                },

            ]
        },
        {
            path:'/login',
            component: Login,
            name: 'login',
            meta:{
                middleware:[guest]
            }
        },
            {
                path:'/register',
                component: Register,
                name: 'register',
                meta:{
                    middleware:[guest]
                }
        }

    ]
});

router.beforeEach( (to, from, next) => {
    if(!to.meta.middleware){
        return next()
    }else{
         const middleware = to.meta.middleware
         const context = {
             to,
             from,
             next,
             store

         };
         return middleware[0]({
             ...context,
            next: middlewarePipLine(context,middleware,1)
         })
        // middleware.forEach(m => {
        //     return m(context);
        // });
    }

  })


export default router;

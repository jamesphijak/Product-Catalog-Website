import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import FindXYZ from '../views/FindXYZ.vue'
import FindBC from '../views/FindBC.vue'
import FindBestRoute from '../views/FindBestRoute.vue'
import LineBot from '../views/LineBot.vue'

Vue.use(VueRouter)

  const routes = [
    { path: '/', name: 'Home', component: Home , meta: { title: 'Curriculum Vitae' }},
    { path: '/findxyz', name: 'FindXYZ', component: FindXYZ , meta: { title: 'Find XYZ' }},
    { path: '/findbc', name: 'FindBC', component: FindBC , meta: { title: 'Find BC' }},
    { path: '/findbestroute', name: 'FindBestRoute', component: FindBestRoute , meta: { title: 'Find Best Route' }},
    { path: '/linebot', name: 'LineBot', component: LineBot , meta: { title: 'Line Bot Video Test' }}
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

const app_name = ' | SCG Assignment'
router.beforeEach((to, from, next) => {
  document.title =  to.meta.title + app_name
  next()
});


export default router

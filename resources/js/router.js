import VueRouter from 'vue-router'

let routes = [
    {
        path : '/',
        name : 'index',
        component: require('./components/Index').default
    },
    {
        path : '/login',
        name : 'login',
        component: require('./components/Login').default
    },
    {
        path : '/register',
        name : 'register',
        component: require('./components/register/Register').default
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});

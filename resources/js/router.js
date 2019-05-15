import VueRouter from 'vue-router'

let routes = [
    {
        path : '/',
        component: require('./components/Index').default
    },
    {
        path : '/login',
        component: require('./components/Login').default
    },
    {
        path : '/register',
        component: require('./components/register/Register').default
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});

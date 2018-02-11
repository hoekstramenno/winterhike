import Router from 'vue-router';
window.Vue.use(Router);


const routes = [
    //{path: '/', component: require('./pages/Dashboard.vue'), name: 'dashboard'},
    {path: '/admin/users', component: require('./pages/Users.vue'), name: 'users'},
    {path: '/admin/groups', component: require('./pages/Groups.vue'), name: 'groups'},
    {path: '/admin/posts', component: require('./pages/Posts.vue'), name: 'posts'},
    {path: '/admin/routes', component: require('./pages/Routes.vue'), name: 'routes'},
    {path: '/admin/settings', component: require('./pages/Settings.vue'), name: 'settings'},
    {path: '/admin/auth', component: require('./pages/Auth.vue'), name: 'auth'},
    {path: '/admin/form/:id', component: require('./pages/Form.vue'), name: 'forms'},
    {path: '/admin/scores', component: require('./pages/Score.vue'), name: 'scores'},
    {path: '/admin/roles', component: require('./pages/Roles.vue'), name: 'roles'},
    {path: '/admin/permissions', component: require('./pages/Permissions.vue'), name: 'permissions'},
    {path: '/admin/result', component: require('./pages/Result.vue'), name: 'result'},
    {path: '/admin/old-result', component: require('./pages/ResultOld.vue'), name: 'oldresult'},
    {path: '/admin/graphs', component: require('./pages/Graphs.vue'), name: 'graphs'},
]

window.router = new Router({ routes });
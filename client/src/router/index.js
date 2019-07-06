import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    //mode: 'hash',
    mode: 'history',
    linkActiveClass: 'active-link',
    linkExactActiveClass: 'exact-active-link',
    routes: [
        {
            path: '/',
            component: resolve => require(['../pages/login'], resolve),
            redirect: '/tag1',
            children: [
                {
                    path: 'tag1',
                    name: 'tag1',
                    props: true,
                    component: resolve => require(['../pages/tag/tag1'], resolve)
                },
                {
                    path: 'tag2/:id',
                    name: 'tag2',
                    props: true,
                    component: resolve => require(['../pages/tag/tag2'], resolve)
                },
                {
                    path: 'tag3/:id',
                    name: 'tag3',
                    props: true,
                    component: resolve => require(['../pages/tag/tag3'], resolve)
                },
                {
                    path: 'tag4/:id',
                    name: 'tag4',
                    props: true,
                    component: resolve => require(['../pages/tag/tag4'], resolve)
                },
                {
                    path: 'tag5/:id',
                    name: 'tag5',
                    props: true,
                    component: resolve => require(['../pages/tag/tag5'], resolve)
                },
                {
                    path: 'tag6/:id',
                    name: 'tag6',
                    props: true,
                    component: resolve => require(['../pages/tag/tag6'], resolve)
                },
                {
                    path: 'tag7/:id',
                    name: 'tag7',
                    props: true,
                    component: resolve => require(['../pages/tag/tag7'], resolve)
                },
                {
                    path: 'tag8/:id',
                    name: 'tag8',
                    props: true,
                    component: resolve => require(['../pages/tag/tag8'], resolve)
                },
                {
                    path: 'tag9/:id',
                    name: 'tag9',
                    props: true,
                    component: resolve => require(['../pages/tag/tag9'], resolve)
                },
                {
                    path: 'tag10/:id',
                    name: 'tag10',
                    props: true,
                    component: resolve => require(['../pages/tag/tag10'], resolve)
                },
                {
                    path: 'tag/:id/detail/:postid',
                    props: true,
                    component: resolve => require(['../pages/tag_detail/tag1_detail'], resolve)
                },
                {
                    path: 'tag4/:id/detail/:aid',
                    props: true,
                    component: resolve => require(['../pages/tag_detail/tag3_detail'], resolve)
                }
            ]
        },
        {
            path: '/index',
            name: '/index',
            component: resolve => require(['../pages/index'], resolve),
            redirect: '/index/u/1',
            children: [
                {
                    path: 'u/:index_id',
                    name: 'indexTag1',
                    props: true,
                    component: resolve => require(['../pages/index/all'], resolve),
                    redirect: '/index/u/1/home',
                    children: [
                        {
                            path: 'home',
                            name: "indexHome",
                            props: true,
                            component: resolve => require(['../pages/index/tag_type/tag_all'], resolve),
                        },
                        {
                            path: 'home/is_word=:index_type_id',
                            name: "indexWord",
                            props: true,
                            component: resolve => require(['../pages/index/tag_type/tag_word'], resolve),
                        },
                        {
                            path: 'home/is_pic=:index_type_id',
                            name: "indexPic",
                            props: true,
                            component: resolve => require(['../pages/index/tag_type/tag_pic'], resolve),
                        },
                        {
                            path: 'home/is_video=:index_type_id',
                            name: "indexVideo",
                            props: true,
                            component: resolve => require(['../pages/index/tag_type/tag_video'], resolve),
                        }
                    ]
                },
                {
                    path: 'fav/:index_id',
                    name: 'indexTag2',
                    props: true,
                    component: resolve => require(['../pages/index/collection'], resolve)
                },
                {
                    path: 'like/:index_id',
                    name: 'indexTag3',
                    props: true,
                    component: resolve => require(['../pages/index/good'], resolve)
                },
                {
                    path: 'hvp/:index_id',
                    name: 'indexTag4',
                    props: true,
                    component: resolve => require(['../pages/index/hotViewPoint'], resolve)
                },
                {
                    path: 'hv/:index_id',
                    name: 'indexTag5',
                    props: true,
                    component: resolve => require(['../pages/index/hotVideo'], resolve)
                }
            ]
        },
        {
            path: '/home',
            name: '/home',
            redirect: '/home/all',
            component: resolve => require(['../pages/home'], resolve),
            children: [
                {
                    path: 'all',
                    name: 'all',
                    meta: {
                        hid: 0
                    },
                    props: true,
                    component: resolve => require(['../pages/home/index'], resolve)
                },
                {
                    path: 'album',
                    name: 'album',
                    meta: {
                        hid: 1
                    },
                    props: true,
                    component: resolve => require(['../pages/home/album'], resolve)
                },
                {
                    path: 'profile',
                    name: 'profile',
                    meta: {
                        hid: 2
                    },
                    props: true,
                    component: resolve => require(['../pages/home/profile'], resolve)
                },
                {
                    path: 'setting',
                    name: 'setting',
                    meta: {
                        hid: 3
                    },
                    props: true,
                    component: resolve => require(['../pages/home/setting'], resolve)
                }
            ]
        },
        {
            path: '/profile',
            name: '/profile',
            component: resolve => require(['../pages/profile'], resolve),
        },
        {
            path: '**', // 错误路由
            redirect: '/' //重定向
        }
    ]
})
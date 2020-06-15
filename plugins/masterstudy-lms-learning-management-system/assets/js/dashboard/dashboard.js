/**
 * @var VueRouter
 * @var stm_lms_components
 */

new Vue({
    router: new VueRouter({
        routes: [
            {
                path: '',
                component: stm_lms_components['home'],
            },
            {
                path: '/courses',
                component: stm_lms_components['courses'],
            },
            {
                path: '/course/:id',
                name: 'course',
                component: stm_lms_components['course'],
                props: true,
            },
            {
                path: '/course/:id/:user_id',
                name: 'course_user',
                component: stm_lms_components['course_user'],
                props: true
            }
        ]
    }),
    el: '#stm-lms-dashboard',
    data: {},
    mounted: function () {
    },
});
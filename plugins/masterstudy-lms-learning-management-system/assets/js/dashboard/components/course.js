/**
 *
 * @var stm_lms_ajaxurl
 */

stm_lms_components['course'] = {
    template: '#stm-lms-dashboard-course',
    props: ['id'],
    components: {
        add_user: stm_lms_components['add_user'],
        back: stm_lms_components['back']
    },
    data: function () {
        return {
            id: 0,
            title: '',
            loading: true,
            students: [],
            pages: 0,
            limit: 20,
            search: '',
        }
    },
    mounted: function () {
        var _this = this;
        _this.id = _this.$route.params.id;

        this.getStudents();
    },
    computed: {
        studentsList: function () {

            var _this = this;

            var students = _this.students.filter(function (course) {
                return course['student']['login'].toLowerCase().indexOf(_this.search.toLowerCase()) !== -1;
            });


            return students.slice(0, this.limit);
        }
    },
    methods: {
        getStudents: function () {
            var _this = this;

            _this.loading = true;

            var url = stm_lms_ajaxurl + '?action=stm_lms_dashboard_get_course_students';
            url += '&course_id=' + _this.id;

            _this.$http.get(url).then(function (data) {

                data = data.body;

                _this.loading = false;

                _this.$set(_this, 'title', data.title);
                _this.$set(_this, 'students', data.students);

            });

        },

        toUser: function (course_id, user_id) {
            this.$router.push({path: '/course/' + course_id + '/' + user_id});
        },

        deleteUserCourse: function (course_id, user, key) {

            if (!confirm('Do you really want to delete this student from course?')) return false;

            var _this = this;

            _this.$set(user, 'loading', true);

            var url = stm_lms_ajaxurl + '?action=stm_lms_dashboard_delete_user_from_course';
            url += '&course_id=' + course_id + '&user_id=' + user.user_id;

            _this.$http.get(url).then(function () {

                _this.$set(user, 'loading', false);

                _this.students.splice(key, 1);


            });
        },
        studentAdded : function() {
            this.getStudents();
        }
    }
};
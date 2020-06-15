/**
 *
 * @var stm_lms_ajaxurl
 */

stm_lms_components['course_user'] = {
    template: '#stm-lms-dashboard-course_user',
    props: ['id', 'user_id'],
    components: {
        back: stm_lms_components['back']
    },
    data: function () {
        return {
            course_title: '',
            id: 0,
            user_id: 0,
            data : [],
            loading: true
        }
    },
    mounted: function () {
        var _this = this;
        _this.id = _this.$route.params.id;
        _this.user_id = _this.$route.params.user_id;

        _this.getStudentProgress();

    },
    computed: {},
    methods: {
        getStudentProgress: function () {
            var _this = this;
            var url = stm_lms_ajaxurl + '?action=stm_lms_dashboard_get_student_progress';

            _this.$http.post(url, {
                course_id: _this.id,
                user_id: _this.user_id,
            }).then(function (data) {
                data = data.body;
                _this.loading = false;

                _this.$set(_this, 'data', data);

            })
        },
        completeItem : function(item) {
            var _this = this;
            _this.$set(item, 'loading', true);

            var url = stm_lms_ajaxurl + '?action=stm_lms_dashboard_set_student_item_progress';

            _this.$http.post(url, {
                course_id: _this.id,
                user_id: _this.user_id,
                item_id: item.item_id,
            }).then(function (data) {
                data = data.body;
                _this.$set(item, 'loading', false);
                _this.$set(_this, 'data', data);
            });
        }
    }
};
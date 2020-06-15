stm_lms_components['add_user'] = {
    template: '#stm-lms-dashboard-add_user',
    props : ['course_id'],
    data: function () {
        return {
            loading : false,
            active: false,
            email: '',
            status: '',
            message: '',
        }
    },
    methods: {
        addStudent: function () {
            var _this = this;

            _this.status = _this.message = '';

            if(_this.email === '') {

                alert('Enter email');
                return false;

            }

            _this.loading = true;
            var url = stm_lms_ajaxurl + '?action=stm_lms_dashboard_add_user_to_course';
            _this.$http.post(url, {
                email: _this.email,
                course_id : _this.course_id,
            }).then(function (data) {
                data = data.body;

                _this.status = data.status;
                _this.message = data.message;

                _this.loading = false;

                _this.email = '';

                _this.$emit('studentAdded');

            });
        }
    }
};
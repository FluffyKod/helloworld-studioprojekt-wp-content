/**
 *
 * @var stm_lms_ajaxurl
 */

stm_lms_components['courses'] = {
    template: '#stm-lms-dashboard-courses',
    components: {
        back: stm_lms_components['back']
    },
    data: function () {
        return {
            loading: false,
            courses: [],
            pages: 1,
            page: 1,
            per_page: 1,
        }
    },
    mounted: function () {

        this.getCourses();
    },
    methods: {
        getCourses: function () {
            var _this = this;

            _this.loading = true;

            var url = stm_lms_ajaxurl + '?action=stm_lms_dashboard_get_courses_list';
            url += '&offset=' + (_this.page - 1);

            _this.$http.get(url).then(function (response) {

                response = response.body;

                _this.loading = false;

                _this.$set(_this, 'courses', response.posts);
                _this.$set(_this, 'pages', response.pages);
                _this.$set(_this, 'per_page', response.per_page);

            });
        },
        switchPage : function(page) {
            this.$set(this, 'page', page);
            this.getCourses();
        }
    }
};
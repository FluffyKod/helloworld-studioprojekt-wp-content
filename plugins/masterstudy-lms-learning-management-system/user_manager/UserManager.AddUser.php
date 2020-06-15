<?php

new STM_LMS_User_Manager_Add_User();

class STM_LMS_User_Manager_Add_User
{

    public function __construct()
    {

        add_action('wp_ajax_stm_lms_dashboard_add_user_to_course', array($this, 'add_user'));

    }

    function add_user()
    {

        $request_body = file_get_contents('php://input');

        $data = json_decode($request_body, true);

        if(empty($data['email'])) die;

        $email = sanitize_text_field($data['email']);
        $course_id = intval($data['course_id']);

        if(!is_email($email)) {
            wp_send_json(array(
                'status' => 'error',
                'message' => esc_html__('Enter valid email', 'masterstudy-lms-learning-management-system')
            ));
        }

        $adding = STM_LMS_Instructor::_add_student_to_course(array($course_id), array($email));

        if(!$adding['error']) {
            $adding['status'] = 'success';
        }

        wp_send_json($adding);

    }

}
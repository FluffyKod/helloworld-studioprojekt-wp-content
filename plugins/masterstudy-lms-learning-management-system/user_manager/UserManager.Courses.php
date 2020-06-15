<?php

new STM_LMS_User_Manager_Courses();

class STM_LMS_User_Manager_Courses
{

    public function __construct()
    {
        add_action('wp_ajax_stm_lms_dashboard_get_courses_list', array($this, 'course_list'));
    }

    function course_list()
    {

        wp_send_json(STM_LMS_Instructor::get_courses(array('posts_per_page' => 25), true, STM_LMS_User_Manager_Interface::isInstructor()));

    }


}
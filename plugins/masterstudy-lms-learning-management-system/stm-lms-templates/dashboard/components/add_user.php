<transition name="slide">

    <div class="add_user">


        <div class="add_user__btn_wrapper">

            <a href="#" class="add_user__btn" @click.prevent="active = true" v-if="!active">

                <?php esc_html_e('Add student', 'masterstudy-lms-learning-management-system'); ?>

            </a>

        </div>

        <div class="add_user_box" v-if="active">

            <span>
                <?php esc_html_e('Enter user email. If email doesnt registered on site, system will create user credentials.', 'masterstudy-lms-learning-management-system'); ?>
            </span>

            <input type="email"
                   v-model="email"
                   v-on:keyup.enter="addStudent()"
                   required
                   placeholder="<?php esc_attr_e('Enter student email', 'masterstudy-lms-learning-management-system'); ?>"/>

            <div class="add_user_box_actions">

                <a href="#"
                   class="button button-secondary"
                   v-bind:class="{'loading' : loading}"
                   @click.prevent="addStudent()">
                    <span><?php esc_html_e('Add', 'masterstudy-lms-learning-management-system'); ?></span>
                </a>

                <a href="#" @click.prevent="active = false">
                    <?php esc_html_e('Close', 'masterstudy-lms-learning-management-system'); ?>
                </a>

            </div>

            <transition name="slide-fade">
                <div class="stm-lms-message" v-bind:class="status" v-if="message">
                    {{ message }}
                </div>
            </transition>

        </div>


    </div>

</transition>
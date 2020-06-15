<transition name="slide">

    <div class="stm-lms-dashboard-inner stm-lms-dashboard-course">

        <back></back>


        <div>

            <h2 v-html="title"></h2>

            <add_user :course_id="id" v-on:studentAdded="studentAdded"></add_user>

            <div class="filter">

                <div class="filter_single">
                    <label><?php esc_html_e('Show on page', 'masterstudy-lms-learning-management-system'); ?></label>
                    <select v-model="limit">
                        <option v-bind:value="20">20</option>
                        <option v-bind:value="30">30</option>
                        <option v-bind:value="40">40</option>
                        <option v-bind:value="50">50</option>
                        <option v-bind:value="100">100</option>
                    </select>
                </div>

                <div class="filter_single">
                    <label><?php esc_html_e('Search by', 'masterstudy-lms-learning-management-system'); ?></label>
                    <input type="text" v-model="search">
                </div>

            </div>

            <div>

                <div class="loading" v-if="loading"></div>

                <table v-else>
                    <thead>
                    <tr>
                        <th class="count"><?php esc_html_e('#', 'masterstudy-lms-learning-management-system'); ?></th>
                        <th class="name"><?php esc_html_e('Student name', 'masterstudy-lms-learning-management-system'); ?></th>
                        <th class="progress_cell"><?php esc_html_e('Progress', 'masterstudy-lms-learning-management-system'); ?></th>
                        <th class="time"><?php esc_html_e('Started', 'masterstudy-lms-learning-management-system'); ?></th>
                        <th class="actions"><?php esc_html_e('Manage', 'masterstudy-lms-learning-management-system'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(list, list_key) in studentsList" v-bind:class="{'table_loading' : list.loading}">

                        <td class="count" v-html="list_key + 1"></td>

                        <td v-html="list.student.login" class="name"></td>

                        <td class="progress_cell">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success"
                                     v-bind:class="{'active progress-bar-striped' : list.progress_percent < 100}"
                                     v-bind:style="{'width': list.progress_percent + '%'}"></div>
                                <span>{{list.progress_percent}}%</span>
                            </div>
                        </td>

                        <td v-html="list.ago" class="time"></td>

                        <td class="actions">

                            <i class="lnr lnr-pencil" @click="toUser(id, list.user_id)"></i>

                            <i class="lnr lnr-trash" @click="deleteUserCourse(id, list, list_key)"></i>

                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>

        </div>

    </div>

</transition>
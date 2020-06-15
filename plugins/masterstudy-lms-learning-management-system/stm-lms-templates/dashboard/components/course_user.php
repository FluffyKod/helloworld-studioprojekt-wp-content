<transition name="slide">

    <div class="stm-lms-dashboard-inner stm-lms-dashboard-course-user">

        <back></back>


        <div class="loading" v-if="loading"></div>

        <div v-else>

            <h3><?php esc_html_e('Curriculum', 'masterstudy-lms-learning-management-system'); ?></h3>


            <div class="progress">
                <div class="progress-bar progress-bar-success"
                     v-bind:class="{'active progress-bar-striped' : data.progress_percent < 100}"
                     v-bind:style="{'width': data.progress_percent + '%'}"></div>
                <span>{{data.progress_percent}}%</span>
            </div>

            <div class="sections">
                <div class="section" v-for="section in data.sections">
                    <h3 v-html="section.number + '. ' + section.title"></h3>

                    <div class="section_items">
                        <div class="section_item" v-for="item in section.section_items" v-bind:class="{'loading' : item.loading}">

                            <h4 class="section_item__title">
                                <strong v-html="item.title"></strong>
                                <span v-html="'(' + item.type + ')'"></span>
                            </h4>

                            <div class="section_item__completed">
                                <label>
                                    <input type="checkbox" v-model="item.completed" v-on:change="completeItem(item)"/>
                                    <span v-html="'<?php esc_html_e('Set as passed'); ?>'"
                                          v-if="!item.completed"></span>
                                    <span v-html="'<?php esc_html_e('Reset progress'); ?>'" v-else></span>
                                </label>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</transition>
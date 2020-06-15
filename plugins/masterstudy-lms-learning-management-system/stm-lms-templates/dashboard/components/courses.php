<transition name="slide">

    <div class="stm-lms-dashboard-inner">

        <back></back>

        <div class="loading" v-if="loading"></div>

        <div v-else>

            <div class="courses">

                <div class="course" v-for="course in courses">
                    <router-link :to="{ name : 'course', params : {id : course.id} }">
                        <div class="course-image" v-html="course.image"></div>
                        <div class="inner">
                            <h4 class="course-title" v-html="course.title"></h4>
                        </div>
                    </router-link>
                </div>

            </div>

            <div class="pagination" v-if="pages > 1">
                <a href="#"
                   v-for="s_page in pages"
                   v-on:click.prevent="switchPage(s_page)"
                   v-bind:class="{'active' : page == s_page}">{{s_page}}</a>
            </div>

        </div>

    </div>

</transition>
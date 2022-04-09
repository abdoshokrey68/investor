<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3 ">
                <div class="card-header p-0 card ">
                    <h5 class="h5 p-3 m-0">
                        {{ lang["search"] }}
                    </h5>
                </div>
                <div class="card pb-2 ">
                    <input
                        type="text"
                        class="form-control mt-2"
                        v-model="search"
                        name="search"
                        id="search"
                        placeholder="Search .."
                    />
                </div>
                <div class="card-body p-0">
                    <div class="card-header p-0 card mt-4">
                        <h5 class="h5 p-3 m-0">
                            <i class="fas fa-money-bill-wave mr-2 ml-2"></i>
                            {{ lang["project_price"] }}
                        </h5>
                    </div>
                    <div class="col-md-12 card  p-2">
                        <label for="price">
                            {{ lang["max_price"] }} : {{ price }} $
                        </label>
                        <input
                            type="range"
                            class="col-md-12 p-0"
                            v-model="price"
                            name="price"
                            id="price"
                            :min="min_price"
                            :max="max_price"
                        />
                        <label for="min_price_search">
                            {{ lang["min_price"] }} :
                            {{ min_price_search }} $</label
                        >
                        <input
                            type="range"
                            class="col-md-12 p-0"
                            v-model="min_price_search"
                            name="min_price_search"
                            id="min_price_search"
                            :min="min_price"
                            :max="max_price"
                        />
                    </div>
                    <div class="card-header p-0 card mt-4">
                        <h5 class="h5 p-3 m-0">
                            <i class="fas fa-users mr-2 ml-2"></i>
                            {{ lang["search_about"] }}
                        </h5>
                    </div>
                    <div class="col-md-12  card p-2">
                        <div class="pl-4">
                            <input
                                type="checkbox"
                                name="user_status"
                                value="0"
                                v-model="user_status"
                                class="form-check-input"
                                id="innovative"
                            />
                            <label
                                for="innovative"
                                class="form-check-label mr-4"
                            >
                                {{ lang["innovative"] }}
                            </label>
                        </div>

                        <div class="pl-4">
                            <input
                                type="checkbox"
                                name="user_status"
                                value="1"
                                v-model="user_status"
                                class="form-check-input"
                                id="investor"
                            />
                            <label for="investor" class="form-check-label mr-4">
                                {{ lang["investor"] }}
                            </label>
                        </div>

                        <div class="pl-4">
                            <input
                                type="checkbox"
                                name="user_status "
                                value="2"
                                v-model="user_status"
                                class="form-check-input"
                                id="financier"
                            />
                            <label
                                for="financier"
                                class="form-check-label mr-4"
                            >
                                {{ lang["financier"] }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="card-header p-0 card mt-4">
                        <h5 class="h5 p-3 m-0">
                            <i class="fas fa-globe-americas mr-2 ml-2"></i>
                            {{ lang["the_country"] }}
                        </h5>
                    </div>

                    <select
                        v-model="country_member"
                        name="country"
                        class="form-select"
                        aria-label="Default select example"
                    >
                        <option selected value=""> Evry one</option>
                        <option
                            class="text-uppercase"
                            v-for="country in countrys"
                            :key="country.index"
                            :value="country"
                        >
                            {{ country }}
                        </option>
                    </select>
                </div>
            </div>
            <!-- End Col-md-3 Class -->
            <div class="col-md-9">
                <div class="new_post mb-3">
                    <a
                        :href="this.newprojectRoute"
                        class="btn btn-outline-secondary btn-block text-center p-3"
                    >
                        <h4 class="p-0 m-0">
                            <i class="fas fa-plus"></i> A New Idea Or Project
                        </h4>
                    </a>
                </div>
                <!-- End Class New Post -->
                <div class="clear"></div>
                <h3 v-if="search">
                    <i class="fas fa-search"></i> {{ lang["search"] }} :
                    {{ search }}
                </h3>
                <h3 v-else class="bold h3 ">{{ lang["all_projects"] }}</h3>
                <hr />
                <div
                    class="text-center bold h3 text-danger"
                    v-if="projects.length == 0"
                >
                    {{ lang["projects_empty"] }}
                </div>
                <div
                    class=" mt-4 mb-2"
                    v-for="(project, index) in projects"
                    :key="index"
                >
                    <div class="col-md-12 p-0">
                        <div class="card col-md-12 p-0">
                            <div class="card-body pt-0 pm-0 pb-0">
                                <div class="row">
                                    <div
                                        class="col-md-4 col-sm-4 col-xs-12 p-0"
                                    >
                                        <img
                                            v-if="project.image"
                                            :src="
                                                '/img/project/' + project.image
                                            "
                                            alt="Project Image"
                                            style="height: 100%; width:100%"
                                        />
                                        <img
                                            v-else
                                            src="/img/project/project.jpg"
                                            alt="Project Image"
                                            style="height: 100%; width:100%"
                                        />
                                    </div>
                                    <div
                                        class="col-md-8 col-sm-8 col-xs-12 p-0"
                                    >
                                        <div class="col-md-12 p-2">
                                            <p
                                                class="bold btn text-center col-md-3"
                                                :class="getClass"
                                                v-if="project.user.status == 0"
                                                style="background: #8e44ad; color:#fff"
                                            >
                                                {{ lang["innovative"] }}
                                            </p>
                                            <p
                                                class="bold btn text-center col-md-3"
                                                :class="getClass"
                                                v-if="project.user.status == 1"
                                                style="background: #16a085; color:#000"
                                            >
                                                {{ lang["investor"] }}
                                            </p>
                                            <p
                                                class="bold btn text-center col-md-3"
                                                :class="getClass"
                                                v-if="project.user.status == 2"
                                                style="background: #34495e; color:#fff"
                                            >
                                                {{ lang["financier"] }}
                                            </p>
                                            <a
                                                :href="'/project/' + project.id"
                                                class="p-2 h5 bold col-md-12"
                                            >
                                                {{ project.name }}
                                            </a>

                                            <br />
                                            <a
                                                :href="'/project/' + project.id"
                                                class="h6 text-dark link-decoration p-2"
                                            >
                                                <p style="line-height: 35px">
                                                    <span class="bold">
                                                        {{ lang["des"] }}
                                                        :</span
                                                    >
                                                    {{ project.des }}
                                                </p>
                                            </a>

                                            <p
                                                class="bold"
                                                v-if="project.min_price"
                                            >
                                                <i
                                                    class="fas fa-money-bill-wave"
                                                ></i>
                                                {{ lang["min_price"] }} :
                                                {{ project.min_price }}$
                                            </p>

                                            <p class="bold">
                                                <i class="fas fa-hashtag"></i>
                                                {{ lang["tags"] }} :
                                                <a
                                                    href="#"
                                                    v-for="tag in project.tags.split(
                                                        ','
                                                    )"
                                                    :key="tag.id"
                                                    >#{{ tag }}
                                                </a>
                                            </p>
                                            <hr />

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div
                                                        class="btn btn-light bold h6 col-md-12"
                                                    >
                                                        <i
                                                            class="fas fa-calendar-alt"
                                                        ></i>
                                                        {{ project.my_date }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <a
                                                        :href="
                                                            '/project/' +
                                                                project.id
                                                        "
                                                        class="btn btn-light bold h6 col-md-12"
                                                    >
                                                        <i
                                                            class="fas fa-comments mr-2 ml-2"
                                                        ></i>
                                                        {{
                                                            project.comments
                                                                .length
                                                        }}
                                                        {{ lang["proposals"] }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Card Class -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import ar from './lang/ar.json';

export default {
    name: "homeComponent",
    props: ["locale", "newprojectRoute"],
    data: function() {
        return {
            projects: [],
            search: "",
            min_price: 0,
            max_price: 0,
            min_price_search: 0,
            price: 0,
            user_status: [],
            countrys: [],
            country_member: "",
            lang: []
        };
    },
    mounted() {
        // console.log("Component projects");
        this.getProjects();
        this.getCountrys();
        this.getLang();
        localStorage.setItem("lang", this.locale);
    },
    computed: {
        getClass() {
            if (this.locale == "en") {
                return "float-end";
            } else {
                return "float-start";
            }
        }
    },
    watch: {
        search: function() {
            this.getProjects();
        },
        country_member: function() {
            this.getProjects();
        },
        user_status: function() {
            this.getProjects();
        },
        price: function() {
            this.getProjects();
        },
        min_price_search: function() {
            this.getProjects();
        }
        // country_member : function () {
        //     for (let i = 0; i < this.projects.length; i++) {
        //         if (this.projects[i].user.country == this.country_member) {
        //             this.projects.push(this.projects[i]);
        //         } else {
        //             this.country_member = 'tes'
        //         }
        //     }
        // }
    },
    methods: {
        getProjects() {
            axios
                .get(
                    `/api/all_projects?search=${this.search}&min_price=${this.min_price_search}&max_price=${this.price}&status=${this.user_status}&country=${this.country_member}`
                )
                .then(res => {
                    console.log(res);
                    this.projects = res.data.all_projects.data;
                    this.min_price = res.data.min_price;
                    this.max_price = res.data.max_price;
                    this.price = res.data.max_price;
                    this.min_price_search = res.data.min_price;
                    // localStorage.setItem(
                    //     "projects",
                    //     JSON.setingify(this.projects)
                    // );
                })
                .catch(error => console.log(error));
        },
        // getProjects() {
        //     axios
        //         .get(`/api/projects_search?search=${this.search}`)
        //         .then(res => {
        //             this.projects = res.data.all_projects;
        //         })
        //         .catch(err => console.log(err));
        // },
        getCountrys() {
            axios
                .get("/api/countrys")
                .then(res => {
                    this.countrys = res.data;
                    // console.log(res);
                })
                .catch(err => console.log(err));
        },
        getLang() {
            let lang = this.locale;
            if (lang == "ar") {
                let lang;
                let ar = {
                    search: "بحث",
                    project_price: " سعر المشروع ",
                    max_price: " أعلي سعر ",
                    min_price: " أقل سعر ",
                    search_about: " بحث عن ",
                    innovative: " أبداعي",
                    investor: " مستثمر ",
                    financier: " ممول ",
                    the_country: " البلد ",
                    all_project: " جميع المشاريع ",
                    projects_empty:
                        ' لا توجد عناصر "استخدم الأدوات للمساعدة في تحسين نتائج البحث" ',
                    edit_project: " تعديل المشروع ",
                    delete_project: " حذف المشروع ",
                    des_project: " تفاصيل المشروع ",
                    tags: " علامات ",
                    proposals: " أقتراحات ",
                    all_projects: " جميع المشاريع"
                };
                this.lang = ar;
            } else {
                let en = {
                    search: "Search",
                    project_price: "Project Price",
                    max_price: "Maximum Price",
                    min_price: "Minimum Price",
                    search_about: "Search About",
                    innovative: "Innovative",
                    investor: "Investor",
                    financier: "Financier",
                    the_country: "The Country",
                    all_project: "All Projects",
                    projects_empty:
                        'There are no items " use Tools to help improve your search results "',
                    edit_project: "Edit Project",
                    delete_project: "Delete Project",
                    des_project: " Description Project",
                    tags: " Tags ",
                    proposals: "Proposals",
                    all_projects: "All Project"
                };
                this.lang = en;
            }
        }
    }
};
// v-if=" user_status.indexOf( project.user.status.toString() ) >= 0"
// v-if=" project.min_price <= price && project.min_price >= min_price_search"
</script>

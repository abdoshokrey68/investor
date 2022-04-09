<template>
    <div class="col-md-12 p-0">
        <div
            class="card p-2 mt-2 box-hover"
            v-for="notice in notices"
            :key="notice.index"
        >
            <a
                :href="getNoticeURL(notices.project_id)"
                class="link-active text-dark"
            >
                <h4 class="h6" :class="getClassShow(notice.show)">
                    {{ getNoticeDes(notice) }}
                </h4>
                <h6 class="h6 float-end">{{ notice.mydate }}</h6>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "NoticeBox",
    data: function() {
        return {
            notices: []
        };
    },
    mounted() {
        this.getNotice();
    },
    methods: {
        getNotice: function() {
            axios
                .get(`/api/notice/85`)
                .then(res => {
                    // console.log(res);
                    this.notices = res.data;
                })
                .catch(err => console.log(err));
        },
        getClassShow(show) {
            if (show == 0) {
                return "bold";
            }
        },
        getNoticeDes(notice) {
            if (this.locale === "en") {
                return notice.des_en.slice(0, 120);
            } else {
                return notice.des_ar.slice(0, 120);
            }
        },
        getNoticeURL(project_id) {
            if (project_id) {
                return "/project/" + project_id;
            } else {
                return `#`;
            }
        }
    },
    props: ["user_id", "locale"]
};
</script>

<template>
    <div class="col-md-12 p-0">

        <div class="col-md-12">
            <h2> <i class="fas fa-comments mr-2 ml-2"></i> Comments Page </h2>
        </div>

        <div class="col-md-12 p-0">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="table_id">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Username</th>
                                <th>Project Name</th>
                                <th>Controller</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeA text-center" v-for="(comment, index) in comments" :key="comment.id">
                                <td> {{index +1}} </td>
                                <td> <a :href="'/profile/'+comment.user.id">{{comment.user.name}}</a> </td>
                                <td> <a :href="'/project/'+comment.project.id">{{comment.project.name}}</a> </td>
                                <td class="p-1">
                                    <button type="button" class="btn btn-dark text-light" data-toggle="modal" :data-target="'#showmessage'+index"> <i class="fas fa-eye"></i> </button>
                                </td>

                                <div class="modal fade text-left" :id="'showmessage'+index" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-user"></i> Comment Information </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12 mb-4">
                                                <img :src="'/img/users/'+comment.user.image" alt="User Image" class="image-res">
                                            </div>
                                            <h6> <span class="bold"> Comment Descreption : </span> {{comment.comment}} </h6>
                                            <h6> <span class="bold"> <i class="fas fa-email"></i> Email : </span> {{comment.user.email}} </h6>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'CommentsCompoent',
        data: function () {
            return {
                comments: [],
            }
        },
        mounted() {
            console.log('Comments Component')
            this.getProjects();
        },
        methods:
        {
            getProjects: function () {
                axios.get('/api/comments_api')
                .then(res   => {
                    this.comments = res.data.data
                    console.log(res)
                })
                .catch(err  => console.log(err))
            },
        }
    }
</script>

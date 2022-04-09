<template>
    <div class="col-md-12 p-0">

        <div class="col-md-12">
            <h2> <i class="fas fa-users mr-2 ml-2"></i> Projects Page </h2>
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
                                <th>Minimum Price</th>
                                <th>Controller</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeA text-center" v-for="(project, index) in projects" :key="project.id">
                                <td> {{index +1}} </td>
                                <td> <a :href="'/profile/'+project.user.id">{{project.user.name}}</a> </td>
                                <td> <a :href="'/project/'+project.id">{{project.name}}</a> </td>
                                <td class="center"> {{project.min_price}} </td>
                                <td class="p-1">
                                    <button type="button" class="btn btn-dark text-light" data-toggle="modal" :data-target="'#showmessage'+index"> <i class="fas fa-eye"></i> </button>
                                    <!--<a href="#" class="btn btn-success text-dark"> <i class="fas fa-edit"></i> </a>
                                    <a href="#" class="btn btn-danger text-dark"> <i class="fas fa-trash"></i> </a> -->
                                </td>

                                <div class="modal fade text-left" :id="'showmessage'+index" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-user"></i> User Information </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12 mb-4">
                                                <img :src="'/img/users/'+project.user.image" alt="User Image" class="image-res">
                                            </div>
                                            <h6> <span class="bold"> Project Descreption : </span> {{project.des}} </h6>
                                            <h6> <span class="bold"> <i class="fas fa-email"></i> Email : </span> {{project.user.email}} </h6>
                                            <h6> <span class="bold"> Comments Count :</span> {{project.comments.length}} </h6>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
        name: 'ProjectCompoent',
        data: function () {
            return {
                projects: [],
            }
        },
        mounted() {
            console.log('Projects Component')
            this.getProjects();
        },
        methods:
        {
            getProjects: function () {
                axios.get('/api/projects_api')
                .then(res   => {
                    this.projects = res.data.data
                    console.log(res)
                })
                .catch(err  => console.log(err))
            },
        }
    }
</script>

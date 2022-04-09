<template>
    <div class="col-md-12 p-0">

        <div class="col-md-12">
            <h2> <i class="fas fa-users mr-2 ml-2"></i> Members Page </h2>

            <div class="col-md-12 p-2 mr-2 mb-2 mt-4">
                <input type="radio" name="unsubscribe" id="unsubscribe" v-model="subscribe" value="0">
                <label for="unsubscribe" class="mr-2 ml-2"> UnSubscribes </label>

                <input type="radio" name="subscribe" id="subscribe" v-model="subscribe" value="1">
                <label for="subscribe" class="mr-2 ml-2"> Subscribes </label>
            </div>
        </div>

        <div class="col-md-12 p-0">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="table_id">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>money</th>
                                <th>Controller</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeA text-center" v-for="(user, index) in users" :key="index" v-if="user.sub == subscribe">
                                <td> {{index +1}} </td>
                                <td> {{user.name}} </td>
                                <td class="center"> {{user.email}} </td>
                                <td class="center"> {{user.coins}} </td>
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
                                                <img :src="'/img/users/'+user.image" alt="User Image" class="image-res">
                                            </div>
                                            <h6> <span class="bold"> <i class="fas fa-email"></i> Email : </span> {{user.email}} </h6>
                                            <h6> <span class="bold"> Project Count :</span> {{user.projects.length}} </h6>
                                            <h6> <span class="bold"> Comments Count :</span> {{user.comments.length}} </h6>

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
        name: 'MembersPage',
        data: function () {
            return {
                users: [],
                subscribe: 1,
                users_data: [],
            }
        },
        watch: {
            subscribe: function () {
                // if (this.subscribe == true) {
                //     this.users = this.user_sub
                // } else {
                //     this.users = JSON.parse(localStorage.getItem('local_users'));
                // }
            }
        },
        mounted() {
            console.log('Mempers Component')
            this.getUsers();
        },
        methods:
        {
            getUsers: function () {
                axios.get('/api/users')
                .then(res   => {
                    this.users = res.data.data
                    this.users_data = res.data
                    localStorage.setItem("local_users", JSON.stringify(this.users));
                    console.log(res)
                })
                .catch(err  => console.log(err))
            },
        }
    }
</script>

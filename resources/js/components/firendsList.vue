<template>
    <div class="col-md-12 p-0">
        <div class="accordion accordion-flash col-md-12 p-0" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                    <button class="btn btn-link text-dark col-md-12 nav-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-align: left">
                        <i class="fas fa-users ml-2 mr-2"></i> Friend Requests
                                    <span class="text-danger bold">{{friends_list.length}}</span>
                        <i class="fas fa-chevron-circle-down mr-2 ml-2 float-end text-dark mt-1"></i>
                    </button>
                    </h5>
                </div>
            </div>

            <div id="collapseOne" class="collapse p-0" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="col-12 p-0" v-for="friend in friends_list" :key="friend.id">
                        <div class="card  golge" v-if="friend.status == 0">
                            <div class="carousel vert slide " id="carouselEx" data-ride="carousel" data-interval="2000">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="list-group">
                                            <div class="list-group-item list-group-item-action align-items-start  mb-1 p-1">
                                                <div class="d-flex justify-content-between align-items-center"  data-toggle="tooltip" title="Bilgisayar Mühendisi">
                                                <img :src="'/img/users/'+friend.user.image" v-if="friend.user.image" class="img-arkadas">
                                                <img src="/img/users/users.png" v-else>
                                                <div class="flex-column mx-1">
                                                    <a :href="'/profile/'+friend.user.id" class="text-dark"><strong> {{friend.user.name}} </strong></a>
                                                </div>
                                                    <div class="row float-end pr-3">
                                                        <a :href="'/friend/accept_request/'+friend.user.id" class="col btn btn-light  golge  " type="a"><i
                                                            class="fas fa-user-plus"></i>
                                                        </a>
                                                        <a :href="'/friend/remove_request/'+friend.user.id" class="col btn btn-danger golge  " type="a"><i
                                                            class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div> <!-- End Of Firends Request Box -->

            <div class="card">
                <div class="card-header" id="headingtwo">
                    <h5 class="mb-0">
                    <button class="btn btn-link text-dark text-auto col-md-12 nav-link" type="button" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo" style="text-align: left">
                        <i class="fas fa-user-friends ml-2 mr-2"></i> All Friends
                        <span class="text-success bold"> 5 </span>
                    </button>
                    </h5>
                </div>
                <div class="col-12 p-0" v-for="friend in friends_list" :key="friend.id">
                    <div class="card  golge" v-if="friend.status == 1">
                            <div class="carousel vert slide " id="carouselEx" data-ride="carousel" data-interval="2000">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="list-group">
                                            <div class="list-group-item list-group-item-action align-items-start  mb-1 p-1">
                                                <div class="d-flex justify-content-between align-items-center"  data-toggle="tooltip" title="Bilgisayar Mühendisi">
                                                    <img :src="'/img/users/'+friend.user.image" v-if="friend.user.image" class="img-arkadas">
                                                    <img src="/img/users/users.png" v-else>
                                                    <div class="flex-column mx-1">
                                                        <a :href="'/profile/'+friend.user.id" class="text-dark"><strong> {{friend.user.name}} </strong></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'firendsList',
        data: function () {
            return {
                friends_list: [],
                test: 'shokrey'
            }
        },
        mounted() {
            console.log('Component Friends')
            this.getFriends();
        },
        methods: {
            getFriends() {
                axios.get('/api/friends')
                .then(res => {
                    this.friends_list = res.data
                })
                .catch(error => console.log(error))
            }
        }
    }
</script>

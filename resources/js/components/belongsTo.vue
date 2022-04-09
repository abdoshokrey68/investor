<template>
    <div class="col-md-12 p-0">
        <div class="row" id="main_box">
            <div class="col-md-2" :data-member='user.id' v-for="user in belongs_to" :key="user.id">
                <button  class="btn" v-on:click="all_belonges(user.id)">
                    <img :src="'/img/users/'+user.image" v-if="user.image" class="mt-2 image-sub" alt="User Image" style="">
                    <img src="/img/users/users.png" v-else class="mt-2 image-sub" alt="User Image" style="">
                </button>
                <button class="btn" v-on:click="all_belonges(user.id)">
                    <h6 class="h6 bold pt-2 text-center">{{user.name}}</h6>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import JQuery from 'jquery';
    import $ from 'jquery';

    export default {
        name: 'BelongsTo',
        data: function () {
            return {
                belongs_to: [],
                age: 0,
                main_id: this.user_id,
            }
        },
        mounted() {
            this.get_belongs();
        },
        methods:
        {
            get_belongs: function () {
                axios.get(`/api/belongsto_api/${this.main_id}`)
                .then(res   => {
                    this.belongs_to = res.data
                })
                .catch(err  => console.log(err))
            },

            all_belonges: function (e) {
                let get_id = e;
                axios.get(`/api/belongsto_api/${get_id}`)
                .then(get_data => {
                    this.appendDiv(get_data, get_id);
                })
                .catch(error => console.log(error))
            }, // أستيراد الجماهير للشخص

            appendDiv(user, this_id)
            {
                let main_el = $('#main_box')
                $('#main_users').remove()
                if (user.data.length > 0) {
                    main_el.append(`</div><div id="member${this_id} main_users" data-member="${this_id}" class="row">  </div>`)
                    let element_appends = $(`#member${this_id}`);
                    for(let i = 0; i < user.data.length; i++)
                    {
                        let html = `<div class='col-md-2' > ${user.data[i]['name']} </div>`;
                        let el =    `<div  class="col-md-2" data-member='${user.data[i]['id']}'>
                                        <button  class="btn" v-on:click="all_belonges(user.id)">
                                            <img src="/img/users/users.png" class="mt-2 image-sub" alt="User Image" style="">
                                        </button>
                                        <button class="btn" v-on:click="all_belonges()">
                                            <h6 class="h6 bold pt-2 text-center">${user.data[i]['name']}</h6>
                                        </button>
                                    </div>`;
                        element_appends.append(el)
                    }
                    // console.log(first_element);
                } else {

                }
                    // console.log(user.data)
                    // console.log(main_el)
            } // أضافة المستخدمين اللذين تم استيرادهم

        },
        props: ['user_id'],
    }


























//     <div id="getbelong" @click='all_belonges()' class="col-md-2" v-for="user in belongs_to" :key="user.id">
//     <a :href="'/work_with_us/'+user.id" @click='all_belonges()'>
//         <img :src="'/img/users/'+user.image" v-if="user.image" class="mt-2 image-sub" alt="User Image" style="">
//         <img src="/img/users/users.png" v-else class="mt-2 image-sub" alt="User Image" style="">
//     </a>
//     <a :href="'/work_with_us/'+user.id" >
//         <h6 class="h6 bold pt-2 text-center">{{user.name}}</h6>
//     </a>
// </div>
</script>



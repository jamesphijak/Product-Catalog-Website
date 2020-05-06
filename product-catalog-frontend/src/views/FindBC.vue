<template>
    <div class="FindBC">
        <Navbar />
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <h1 class="card-title">Find BC</h1>
                            <h4 class="card-subtitle mb-2 text-muted">If A = 21, A + B = 23, A + C = -21 - Please create a new function for finding B and C value</h4>
                            <br>
                            <ul class="list-group list-group-horizontal justify-content-center">
                                 <li class="list-group-item">A</li>
                                 <li class="list-group-item">=</li>
                                 <li class="list-group-item">{{ a }}</li>
                            </ul>
                            <br>
                            <ul class="list-group list-group-horizontal justify-content-center">
                                 <li class="list-group-item">A</li>
                                 <li class="list-group-item">+</li>
                                 <li class="list-group-item" style="background-color:red; color:white;">B</li>
                                 <li class="list-group-item">=</li>
                                 <li class="list-group-item">{{ ans_b }}</li>
                            </ul>
                            <br>
                            <ul class="list-group list-group-horizontal justify-content-center">
                                 <li class="list-group-item">A</li>
                                 <li class="list-group-item">+</li>
                                 <li class="list-group-item" style="background-color:red; color:white;">C</li>
                                 <li class="list-group-item">=</li>
                                 <li class="list-group-item">{{ ans_c }}</li>
                            </ul>

                            <br>
                            <button type="button" @click="onFindBC()" class="btn btn-primary ">Find B & C</button>
                            <br><br>

                            <ul v-if="b != ''" class="list-group list-group-horizontal justify-content-center">
                                 <li class="list-group-item">B</li>
                                 <li class="list-group-item">=</li>
                                 <li class="list-group-item">{{ b }}</li>
                            </ul>
                            <br>
                            <ul v-if="c != ''" class="list-group list-group-horizontal justify-content-center">
                                 <li class="list-group-item">C</li>
                                 <li class="list-group-item">=</li>
                                 <li class="list-group-item">{{ c }}</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Bottombar />
    </div>
</template>

<script>
    import Navbar from '../components/Navbar.vue';
    import Bottombar from '../components/Bottombar.vue';
    import axios from 'axios';
    export default {
        name: "onFindBC",
        data() {
            return {
                a: 21,
                ans_b: 23,
                ans_c: -21,
                b: '',
                c: ''
            };
        },
        components: {
            Navbar,
            Bottombar
        },
        methods: {
            // Login
            onFindBC() {
                const url = process.env.VUE_APP_API_URL
                const response = axios.post(url + "/api/doscg/getBC", { "a":this.a , "ans_b": this.ans_b , "ans_c":this.ans_c} )
                    .then(response => {
                        console.log(response.data);
                        this.b = response.data.message.b
                        this.c = response.data.message.c
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    };
</script>

<style scoped>
    .list-group {
        font-size: 15px;
    }
</style>
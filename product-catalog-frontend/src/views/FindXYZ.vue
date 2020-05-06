<template>
    <div class="FindXYZ">
        <Navbar />
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <h1 class="card-title">Find XYZ</h1>
                            <h4 class="card-subtitle mb-2 text-muted">X, Y, 5, 9, 15, 23, Z - Please create a new function for finding X, Y, Z value</h4>
                            <!-- <img src="/images/resume.jpg" alt="Logo" class="img-logo"> -->
                            <br>
                            <ul class="list-group list-group-horizontal justify-content-center">
                                <li v-for="(item, index) in missing_list" :key="index" class="list-group-item">{{ item }}</li>
                            </ul>
                            <br>
                            <button type="button" @click="onFindXYZ()" class="btn btn-primary ">Find Mising values</button>
                            <br><br>

                            <ul v-if="found_list.length > 0" class="list-group list-group-horizontal justify-content-center">
                                <li v-for="(item, index) in found_list" :key="index" class="list-group-item">{{ item }}</li>
                            </ul>
                            <br>
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
        name: "FindXYZ",
        data() {
            return {
                missing_list: ["", "", 5, 9, 15, 23, ""],
                found_list: []
            };
        },
        components: {
            Navbar,
            Bottombar
        },
        methods: {
            // Login
            onFindXYZ() {
                const url = process.env.VUE_APP_API_URL
                const response = axios.post(url + "/api/doscg/getXYZ", { "missing_list":this.missing_list} )
                    .then(response => {
                        console.log(response.data);
                        this.found_list = response.data.message
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
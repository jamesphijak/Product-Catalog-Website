<template>
    <div class="FindBestRoute">
        <Navbar />
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title text-center"><i class="fas fa-map-marked-alt"></i> Find Best Route
                            </h1>
                            <h4 class="card-subtitle mb-2 text-muted text-center">Please use “Google API” for finding
                                the best way
                                to go to Central World from SCG Bangsue</h4>

                            <br>
                            <ul class="list-group list-group-horizontal justify-content-center">
                                <li class="list-group-item">{{ raw_origin }}</li>
                                <li class="list-group-item">to</li>
                                <li class="list-group-item">{{ raw_destination }}</li>
                            </ul>
                            <br>
                            <button type="button" @click="onFindPlaceDetail()"
                                class="btn btn-primary btn-lg btn-block">Find Place</button>
                            <br>
                            <ul v-if="place_origin_name != '' && place_destination_name != '' "
                                class="list-group list-group-horizontal justify-content-center">
                                <li class="list-group-item">{{ place_origin_name }}</li>
                                <li class="list-group-item">to</li>
                                <li class="list-group-item">{{ place_destination_name }}</li>
                            </ul>
                            <br>

                            <div v-if="place_origin_photo != '' && place_destination_photo != '' "
                                class="row text-center">
                                <div class="col-md-6">
                                    <img :src="place_origin_photo" alt="origin" class="img-fluid">
                                </div>
                                <div class="col-md-6">
                                    <img :src="place_destination_photo" alt="destination" class="img-fluid">
                                </div>
                            </div>

                            <!-- <ul v-if="found_list.length > 0" class="list-group list-group-horizontal justify-content-center">
                                <li v-for="(item, index) in found_list" :key="index" class="list-group-item">{{ item }}
                                </li>
                            </ul> -->
                            <br>
                            <button v-if="place_origin_name != '' && place_destination_name != '' " type="button"
                                @click="onFindBestRoute()" class="btn btn-success btn-lg btn-block">Find Best
                                Route</button>
                            <br>
                            <div class="row" v-if="open_details != false">
                                <div class="col-md-6">
                                    <h2 class=" text-center"><i class="fas fa-info-circle"></i> Details</h2>
                                    <hr>

                                    <div class="justify-content-center"><img :src="map" alt="destination" class="img-fluid">
                                    </div>
                                    <br>
                                    <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Distance:</th>
                                                <td>{{ distance }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Duration:</th>
                                                <td>{{ duration }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Summary</th>
                                                <td>{{ summary }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Start address:</th>
                                                <td>{{ start_address }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">End address:</th>
                                                <td>{{ end_address }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Step Counts:</th>
                                                <td>{{ steps.length }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Map URL</th>
                                                <td><a v-bind:href="mapurl" target="_blank">{{ mapurl }}</a></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h2 class=" text-center"> <i class="fas fa-walking"></i> Steps</h2>
                                    <hr>
                                    <ul class="timeline">
                                        <li v-for="(item, index) in steps" :key="index">
                                            <a>{{ item.distance.text }}</a>
                                            <a class="float-right">{{ item.duration.text }}</a>
                                            <p v-html="item.html_instructions"></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
    const url = process.env.VUE_APP_API_URL;
    export default {
        name: "FindBestRoute",
        data() {
            return {
                raw_origin: "SCG Bangsue",
                raw_destination: "Central World",
                place_origin_name: "",
                place_destination_name: "",
                place_origin_photo: "",
                place_destination_photo: "",
                start_address: "",
                end_address: "",
                distance: "",
                duration: "",
                summary: "",
                steps: "",
                open_details: false,
                encoded_polyline: "",
                map: "",
                mapurl: ""

            };
        },
        components: {
            Navbar,
            Bottombar
        },
        methods: {
            // Login
            onFindPlaceDetail() {
                const find_origin = axios.post(url + "/api/doscg/getPlace", {
                        "name": this.raw_origin
                    })
                    .then(response => {
                        console.log(response.data);
                        this.place_origin_name = response.data.message.name;
                        this.place_origin_photo = response.data.message.photo;
                    })
                    .catch(error => {
                        console.log(error);
                    });

                const find_destination = axios.post(url + "/api/doscg/getPlace", {
                        "name": this.raw_destination
                    })
                    .then(response => {
                        console.log(response.data);
                        this.place_destination_name = response.data.message.name;
                        this.place_destination_photo = response.data.message.photo;
                    })
                    .catch(error => {
                        console.log(error);
                    });


            },
            onFindBestRoute() {
                const find_route = axios.post(url + "/api/doscg/getRoute", {
                        "origin": this.place_origin_name,
                        "destination": this.place_destination_name
                    })
                    .then(response => {
                        console.log(response.data);
                        this.distance = response.data.message.legs[0].distance.text
                        this.duration = response.data.message.legs[0].duration.text
                        this.summary = response.data.message.summary;
                        this.start_address = response.data.message.legs[0].start_address
                        this.end_address = response.data.message.legs[0].end_address
                        this.steps = response.data.message.legs[0].steps
                        this.encoded_polyline = response.data.message.overview_polyline.points
                        this.open_details = true;
                        this.mapurl = "https://www.google.com/maps/dir/?api=1&origin="+ this.place_origin_name +"&destination=" + this.place_destination_name + "&travelmode=driving"

                        let config = {
                            // example url
                            url: url + '/api/doscg/getStaticMap',
                            method: 'POST',
                            responseType: 'arraybuffer',
                            data: {
                                encoded_polyline: this.encoded_polyline
                            }
                        }
                        axios(config)
                            .then((response) => {
                                var bytes = new Uint8Array(response.data);
                                var binary = bytes.reduce((data, b) => data += String.fromCharCode(b), '');
                                this.map = "data:image/png;base64," + btoa(binary);
                            })
                            .catch(error => {
                                console.log(error);
                            });

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
        font-size: 20px;
    }

    ul.timeline {
        list-style-type: none;
        position: relative;
    }

    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }

    ul.timeline>li {
        margin: 20px 0;
        padding-left: 20px;
    }

    ul.timeline>li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }
</style>
<template>
    <div class="LineBot">
        <Navbar />
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <h1 class="card-title">Line Bot API Video Test</h1>
                            <h4 class="card-subtitle mb-2 text-muted">Please create a small project using Line messaging
                                API for getting a notification when your Line Bot can not answer a question to the
                                customer more than 10 second</h4>
                                <br>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/3gN9IKdcl8o"
                                    allowfullscreen></iframe>
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

    export default {
        name: "LineBot",
        components: {
            Navbar,
            Bottombar
        }
    };
</script>

<style scoped>

</style>
<template>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" @click="redirectHome">
            <img src="/images/logo.png" alt="Logo">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" @click="redirectHome">Curriculum Vitae</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Back-end API
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" @click="redirectFindXYZ">Find XYZ</a>
                        <a class="dropdown-item" @click="redirectFindBC">Find BC</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" @click="redirectFindBestRoute">Find Best Route From Google Map API</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="redirectLineBot">Line Bot Message API Video</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "Navbar",
        methods: {
            redirectHome() {
                this.$router.push({name: "Home"});
            },
            redirectFindXYZ() {
                this.$router.push({name: "FindXYZ"});
            },
            redirectFindBC() {
                this.$router.push({name: "FindBC"});
            },
            redirectFindBestRoute() {
                this.$router.push({name: "FindBestRoute"});
            },
            redirectLineBot() {
                this.$router.push({name: "LineBot"});
            }
        }
    }
</script>
<style scoped>
    .navbar {
        background: #ffffff;
        border-bottom: solid 2px #ed1c24;
        padding-top: 0px;
        /* padding-right: 0px; */
        z-index: 1;
    }

    .navbar-brand img {
        width: 262px;
        margin-top: 5px;
    }

    .navbar-nav{
        margin-top: 5px;
        font-size: 20px;
    }

    .navbar-nav .nav-item .nav-link{
        color:#ed1c24;
    }

    .navbar .navbar-nav a:active{
        background-color:#ed1c24;
        color: #ffffff;
    }

    
</style>
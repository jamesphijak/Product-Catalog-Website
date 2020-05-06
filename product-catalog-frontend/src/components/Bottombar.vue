<template>
    <footer class="footer mt-auto py-3 text-center">
        <span class="text-muted">Created by Phijak Chanyawiwatkul.</span>
    </footer>
</template>

<script>
    export default {
        name: "Bottombar"
    }
</script>
<style scoped>
    footer {
        background: #ffffff;
        border-top: solid 2px #ed1c24;
        padding-top: 0px;
        padding-right: 0px;
        z-index: 1;
        clear: both;
        position: relative;
        margin-top: -200px;
    }

    span {
        font-size: 20px;
    }

    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }


    /* 
    .navbar-brand img {
        width: 262px;
        margin-top: 5px;
    }

    .navbar-nav {
        margin-top: 5px;
        font-size: 20px;
    }

    .navbar-nav .nav-item .nav-link {
        color: #ed1c24;
    }

    */
</style>
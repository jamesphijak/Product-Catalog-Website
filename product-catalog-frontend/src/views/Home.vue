<template>
  <div class="Home">
    <Navbar/>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card text-center">
            <div class="card-body">
              <h1 class="card-title">Curriculum Vitae</h1>
              <h3 class="card-subtitle mb-2 text-muted">Mr. Phijak Chanyawiwatkul (James)</h3>
              <img src="/images/resume.png" alt="Logo" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
    <Bottombar/>
  </div>
</template>

<script>
  import Navbar from '../components/Navbar.vue';
  import Bottombar from '../components/Bottombar.vue';

  export default {
    name: "Home",
    components: {
      Navbar,
      Bottombar
    }
  };
</script>

<style scoped>
    /* .card-body {
        padding-left: 15%;
        padding-right: 15%;
    }

    .card {
        margin-top: 10%;
        margin-bottom: 15%;
    } */

    

</style>
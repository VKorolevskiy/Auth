<template>
  <div>
    <app-navbar />
    <b-container>
      <nuxt />
    </b-container>
  </div>
</template>
<script>
import AppNavbar from '../components/app/navbar'
export default {
  components: {AppNavbar},
}
</script>

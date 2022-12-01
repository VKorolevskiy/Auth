<template>
  <b-navbar variant="light" toggleable="sm">
    <b-container>
      <b-navbar-toggle target="nav-collapse" />
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="d-flex w-100">
          <b-nav-dropdown v-if="$auth.loggedIn" :text="$auth.user.fullname" class="ml-md-auto" right>
            <b-dropdown-item v-if="$hasScope('profile')" :to="{name: 'user-profile'}">
              {{ $t('security.profile') }}
            </b-dropdown-item>
            <b-dropdown-divider />
            <b-dropdown-item link-class="d-flex align-items-center justify-content-between" @click.prevent="onLogout">
              {{ $t('security.logout') }}
              <fa icon="sign-out-alt" class="ml-auto" />
            </b-dropdown-item>
          </b-nav-dropdown>
          <b-nav v-else :text="$t('actions.submit')" class="ml-md-auto" right>
            <b-nav-item :to="{name: 'login'}">
              {{ $t('security.login') }}
            </b-nav-item>
            <b-nav-item :to="{name: 'register'}">
              {{ $t('security.register') }}
            </b-nav-item>
          </b-nav>
        </b-navbar-nav>
      </b-collapse>
    </b-container>
  </b-navbar>
</template>

<script>
export default {
  name: 'AppNavbar',
  data() {
    return {
      siteName: process.env.SITE_NAME,
    }
  },
  methods: {
    async onLogout() {
      await this.$auth.logout()
      this.$toast.info(this.$t('security.goodbye'))
    },
  },
}
</script>

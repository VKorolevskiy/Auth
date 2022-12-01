<template>
  <div class="shadow-lg p-4 bg-white rounded-lg col-xs-12 col-sm-12 col-md-8 col-lg-5">
    <div v-if="$auth.loggedIn">{{ $t('greetings.title') }}</div>
    <div v-else>
      <b-navbar-brand :to="{name: 'index'}" class="p-2">
        <b-img src="@/assets/images/logo-vesp-nav.svg" width="150" height="40" />
      </b-navbar-brand>
      <b-form ref="form" @submit.prevent="submit">
        <b-form-group class="pt-3">
          <b-form-input v-model.trim="login.username" :placeholder="$t('security.username')" required autofocus />
        </b-form-group>
        <b-form-group class="pt-3">
          <b-form-input v-model.trim="login.fullname" :placeholder="$t('models.user.fullname')" required />
        </b-form-group>
        <b-form-group class="pt-3">
          <vesp-input-email v-model.trim="login.email" :placeholder="$t('security.email')" />
        </b-form-group>
        <input type="submit" class="d-none btn" />
      </b-form>
      <b-btn variant="primary" :disabled="loading" @click="formSubmit">
        {{ $t('actions.submit') }}
      </b-btn>
    </div>
  </div>
</template>
<script>
export default {
  name: 'AppLogin',
  data() {
    return {
      loading: false,
      login: {
        username: '',
        password: '',
      },
    }
  },
  methods: {
    formSubmit() {
      this.$refs.form.querySelector('[type="submit"]').click()
    },
    async submit() {
      this.loading = true
      try {
        await this.$auth.login({data: this.login})
        await this.$toast.info(this.$t('security.greetings'))
        this.onReset()
      } catch (err) {
        console.error(err)
      } finally {
        this.loading = false
      }
    },
    onReset() {
      this.login = {
        username: '',
        password: '',
      }
    },
  },
}
</script>

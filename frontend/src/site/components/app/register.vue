<template>
  <div class="shadow-lg p-4 bg-white rounded-lg col-xs-12 col-sm-12 col-md-8 col-lg-5">
    <div v-if="!showCodeForm">
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
          <b-form-input v-model.trim="login.email" :placeholder="$t('models.user.email')" type="email" />
        </b-form-group>
        <b-form-group class="pt-3">
          <vesp-input-password v-model.trim="login.password" :placeholder="$t('security.password')" />
        </b-form-group>
        <b-form-group class="pt-3">
          <vesp-input-password v-model.trim="login.confirmpassword" :placeholder="$t('security.confirmpassword')" />
        </b-form-group>
        <input type="submit" class="d-none btn" />
      </b-form>
      <b-btn variant="primary" @click="registerSubmit">
        {{ $t('actions.submit') }}
      </b-btn>
    </div>
    <div v-else>
      <app-verified v-model="login" />
    </div>
  </div>
</template>
<script>
import AppVerified from '../app/verified'
const url = 'registration'
export default {
  name: 'AppLogin',
  components: {AppVerified},
  data() {
    return {
      showCodeForm: 0,
      login: {
        id: '',
        action_code: '',
        username: '',
        password: '',
        fullname: '',
        email: '',
        confirmpassword: '',
      },
    }
  },
  methods: {
    async registerSubmit() {
      if (this.login.password !== this.login.confirmpassword) {
        this.$toast.error(this.$t('errors.security.confirmpassword'))
        return false
      }
      // this.loading = false
      // this.record.show = false
      try {
        const response = await this.$axios.post(url, this.login)
        this.login.id = response.data.id
        console.log(this.login.id)
        this.showCodeForm = 1
        // this.$toast.info(this.$t('models.user.action_sms'))
      } catch (err) {
        // this.record.show = true
        // this.actionRegister()
        console.error(err)
      } finally {
        // this.loading = true
      }
    },
  },
}
</script>

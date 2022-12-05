<template>
  <div>
    <div class="p-4 sm:p-8 bg-white shadow rounded m-4">
      <b-form @submit.prevent="onSubmit">
        <form-profile v-model="record" />
        <b-button variant="primary" type="submit">{{ $t('actions.submit') }}</b-button>
      </b-form>
    </div>
    <div class="p-4 sm:p-8 bg-white shadow rounded m-4">
      <b-form @submit.prevent="onSubmit">
        <form-password v-model="record" />
        <b-button variant="primary" type="submit">{{ $t('actions.submit') }}</b-button>
      </b-form>
    </div>
  </div>
</template>

<script>
import FormProfile from '../components/forms/profile'
import FormPassword from '../components/forms/password'
export const url = 'user/profile'
export default {
  name: 'ProfilePage',
  components: {FormProfile, FormPassword},
  data() {
    return {
      loading: false,
      record: {},
    }
  },
  head() {
    return {
      title: this.$t('security.profile') + ' / ' + this.$t('project'),
    }
  },
  mounted() {
    this.setForm()
  },
  methods: {
    setForm() {
      this.record = {...this.$auth.user}
    },
    async onSubmit() {
      this.loading = true
      if (this.record.newpassword !== this.record.newconfirmpassword) {
        this.$toast.error(this.$t('errors.security.confirmpassword'))
        return false
      }
      try {
        const {data} = await this.$axios.patch(url, this.record)
        this.$auth.setUser(data.user)
        this.setForm()
        await this.$toast.success(this.$t('security.success_update_message'))
      } catch (e) {
      } finally {
        this.loading = false
      }
    },
  },
}
</script>

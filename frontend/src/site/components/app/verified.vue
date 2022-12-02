<template>
  <div>
    <p>Мы отправили письмо c кодом на вашу почту</p>
    <b-form-group>
      <b-form-input v-model.trim="login.action_code" required autofocus :placeholder="$t('models.user.action_code')" />
    </b-form-group>
    <div class="text-left">
      <b-btn variant="primary" @click="onAction()">{{ $t('actions.submit') }}</b-btn>
    </div>
  </div>
</template>
<script>
const urlAction = 'action'
export default {
  name: 'AppVerified',
  props: {
    value: {
      type: Object,
      required: true,
    },
  },
  computed: {
    login: {
      get() {
        return this.value
      },
      set(newValue) {
        this.$emit('input', newValue)
      },
    },
  },
  methods: {
    async onAction() {
      // this.loading = false
      // this.record.show = false
      console.log(this.login.id)
      try {
        await this.$axios.post(urlAction, this.login)
        this.$toast.info(this.$t('security.success'))
        this.$router.replace('/login')
      } catch (err) {
        console.error(err)
      } finally {
        this.onReset()
        // this.loading = true
      }
    },
    onReset() {
      this.login = {
        id: '',
        action_code: '',
        username: '',
        password: '',
        fullname: '',
        email: '',
        confirmpassword: '',
      }
    },
  },
}
</script>

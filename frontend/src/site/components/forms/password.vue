<template>
  <div>
    <b-form-group :label="$t('models.user.oldpassword')">
      <vesp-input-password v-model.trim="record.oldpassword" />
    </b-form-group>
    <b-form-group :label="$t('models.user.newpassword')">
      <vesp-input-password v-model.trim="record.newpassword" />
    </b-form-group>
    <b-form-group :label="$t('models.user.newconfirmpassword')">
      <vesp-input-password v-model.trim="record.newconfirmpassword" />
    </b-form-group>
  </div>
</template>
<script>
export default {
  name: 'FormPassword',
  props: {
    value: {
      type: Object,
      required: true,
    },
  },
  computed: {
    record: {
      get() {
        return this.value
      },
      set(newValue) {
        this.$emit('input', newValue)
      },
    },
  },
}
</script>

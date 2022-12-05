<template>
  <div>
    <b-form-group :label="$t('models.user.username')">
      <b-form-input v-model="record.username" required autofocus />
    </b-form-group>

    <b-form-group :label="$t('models.user.fullname')">
      <b-form-input v-model="record.fullname" />
    </b-form-group>
    <b-form-group :label="$t('models.user.phone')">
      <vesp-input-text-mask
        v-model="record.phone"
        mask="+7 (XXX) XXX-XX-XX"
        placeholder-char="X"
        :state="!record.phone ? null : record.phone.length === 12"
        :format-value="(value) => value.replaceAll(/[^\d+]/g, '')"
      />
    </b-form-group>
    <b-form-group :label="$t('models.user.email')">
      <b-form-input v-model.trim="record.email" type="email" />
    </b-form-group>
  </div>
</template>

<script>
export default {
  name: 'FormProfile',
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

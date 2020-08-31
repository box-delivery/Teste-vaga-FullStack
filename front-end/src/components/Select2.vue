<template lang="html">
  <select v-bind:name="name" class="form-control"
    v-bind:multiple="multiple">
  </select>
</template>

<script>
export default {
  props: {
    name: '',
    options: {
      Object,
    },
    value: null,
    multiple: {
      Boolean,
      default: false,
    },
    placeholder: {
      String,
      default: 'Selecione',
    },
  },

  data() {
    return {
      select2data: [],
    };
  },

  mounted() {
    this.formatOptions();

    const vm = this;
    const select = $(this.$el);

    select
      .select2({
        placeholder: this.placeholder,
        width: '100%',
        data: this.select2data,
        dropdownAutoWidth: true,
      })
      .on('change', () => {
        vm.$emit('input', select.val());
      });

    select.val(this.value).trigger('change');
  },

  methods: {
    formatOptions() {
      for (const key in this.options) {
        this.select2data.push({ id: this.options[key].id, text: this.options[key].text });
      }
    },
  },
  destroyed() {
    $(this.$el).off().select2('destroy');
  },
};
</script>

<style lang="css">
</style>

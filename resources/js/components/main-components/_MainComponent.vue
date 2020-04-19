<template>
  <div class="container">
   <form-component
    :content="contentData.mainForm"
    :data="propsData"
   ></form-component>
  </div>
</template>

<script>
import FormComponent from './FormComponent.vue';

export default {
  components: {
    'form-component': FormComponent,
  },
  props: {
    propsData: {
      type: Object,
      required: true,
    },
    contentData: {
      type: Object,
      required: true,
    },
  },
  mounted() {
    console.log(this.propsData);
  },
};
</script>

<style></style>

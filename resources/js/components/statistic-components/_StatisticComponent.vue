<template>
  <div class="container">
    <div class="py-4">
      <h3>
        {{ contentData.h3Caption }}
        <span><a :href="propsData.currentLink">{{ propsData.currentLink }} </a></span>
      </h3>
    </div>
    <div v-if="propsData.links === null">
      <hr>
      <p>
        {{ contentData.noDataCaption }}
      </p>
    </div>
    <table class="table">
      <thead v-if="propsData.links !== null">
        <tr>
          <th scope="col">
            #
          </th>
          <th scope="col">
            {{ contentData.dateCaption }}
          </th>
          <th scope="col">
            {{ contentData.countryCaption }}
          </th>
          <th scope="col">
            {{ contentData.cityCaption }}
          </th>
          <th scope="col">
            {{ contentData.userAgentCaption }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(link, index) in propsData.links"
          :key="index"
        >
          <th scope="row">
            {{ index + 1 }}
          </th>
          <td>{{ link.date }}</td>
          <td>{{ link.country }}</td>
          <td>{{ link.city }}</td>
          <td>{{ link.userAgent }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

export default {
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
    console.log(this.propsData.links);
  },
};
</script>
<style></style>

<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-8 py-5">
        <h1 class="font-weight-bold">
          {{ content.pageCaption }}
        </h1>
        <hr>
        <form
          id="editForm"
          method="post"
          :action="data.indexRoute"
        >
            <input
      type="hidden"
      name="_token"
      :value="csrf"
    >
          <div class="form-group">
              <label for="addFormTaskInput">{{ content.inputUrlCaption }}</label>
              <textarea
                id="urlInputTextarea"
                class="form-control"
                name="userUrl"
                rows="3"
                :value="data.userLink"
                required/>
            </div>
                      <button
            type="submit"
            class="btn btn-primary"
          >
            {{ content.buttonCaption }}
          </button>
          
          <div class="form-group py-5">
            <label for="exampleInputEmail1">{{ content.shortLinkCaption }}</label>
            <input
              id="inputLogin"
              type="text"
              class="form-control"
              name="email"
              :value="data.shortLink"
            >
          </div>
                    <div class="form-group">
            <label for="exampleInputEmail1">{{ content.statisticLinkCaption }}</label>
            <input
              id="inputLogin"
              type="text"
              class="form-control"
              name="email"
              value="http://poker.devmasta.ru.com/ghR45"
            >
          </div>

          <!-- <small
              v-if="propsData.error"
              id="emailHelp"
              class="form-text text-danger"
            >{{ propsData.error }}</small> -->
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    data: {
      type: Object,
      required: true,
    },
    content: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content'),
    };
  },
  mounted() {console.log(this.data)},
};
</script>

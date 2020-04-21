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
          <input
            type="hidden"
            name="newLink"
            :value="data.shortLink"
          >
          <div
            v-if="data.shortLink"
            class="form-group"
          >
            <label
              class="text-success"
              for="shortLink"
            >{{
              content.shortLinkCaption
            }}</label>
            <input
              id="shortLink"
              type="text"
              class="form-control"
              name="shortLink"
              :value="data.shortLink"
              readonly
            >
          </div>
          <div
            v-if="data.statisticLink"
            class="form-group"
          >
            <label
              class="text-success"
              for="statisticLink"
            >{{
              content.statisticLinkCaption
            }}</label>
            <input
              id="statisticLink"
              type="text"
              class="form-control"
              name="statisticLink"
              :value="data.statisticLink"
              readonly
            >
          </div>
          <div
            class="form-group"
          >
            <label for="urlInputTextarea">{{
              content.inputUrlCaption
            }}</label>
            <textarea
              id="urlInputTextarea"
              class="form-control"
              name="userUrl"
              rows="3"
              :value="data.userLink"
              required
            />
            <small
              v-if="data.error"
              class="form-text text-danger"
            >{{ data.error }}</small>
          </div>
          <button
            v-if="data.shortLink === null || data.error !== null"
            type="submit"
            class="btn btn-primary"
          >
            {{ content.buttonCaption }}
          </button>
          <button
            v-if="data.shortLink !== null && data.error === null"
            type="submit"
            class="btn btn-primary"
          >
            {{ content.newButtonCaption }}
          </button>

          <div
            v-if="data.shortLink === null || data.error !== null"
            class="form-group py-4"
          >
            <label for="datePicker">{{
              content.datePickerCaption
            }}</label>
            <datepicker
              :value="vmodelDate"
              :disabled-dates="disabledFn"
              name="dataPicker"
              placeholder=" указать дату"
            />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';

export default {
    components: {
        Datepicker,
    },
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
            disabledFn: {
                customPredictor(date) {
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    if (date < today) {
                        return true;
                    }
                },
            },
            vmodelDate: null
        };
    },
    computed: {
        getCurrentDate() {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return today;
        },
    },
    mounted() {
    },
};
</script>

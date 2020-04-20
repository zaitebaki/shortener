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
            type="submit"
            class="btn btn-primary"
          >
            {{ content.buttonCaption }}
          </button>
          <div class="form-group py-4">
            <label for="datePicker">{{
              content.datePickerCaption
            }}</label>
            <datepicker
              :value="vmodelDate"
              :disabled-dates="disabledFn"
              placeholder=" указать дату"
            />
          </div>
           <div class="form-group">
            <label for="exampleInputEmail1">{{
              content.shortLinkCaption
            }}</label>
            <input
              id="inputLogin"
              type="text"
              class="form-control"
              name="email"
              :value="data.shortLink"
            >
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">{{
              content.statisticLinkCaption
            }}</label>
            <input
              id="inputLogin"
              type="text"
              class="form-control"
              name="email"
              value="http://poker.devmasta.ru.com/ghR45"
            >
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
        console.log(this.getCurrentDate);
    },
};
</script>

<template>
  <div>
    <Layout></Layout>
    <Head title="Login" />
    <div class="container">
      <div class="row justify-content-center mt-5 mb-5">
        <div class="col-lg-4 col-md-4 col-sm-6 col-10 mt-5 mb-5 border border-dark rounded bg-dark">
          <form @submit.prevent="submit" class="mt-5 mb-5">
            <h2 class="text-white">Please login to your account</h2>
            <div v-if="flash.message" class="text-warning">
              {{ flash.message }}
            </div>
            <div class="mb-3">
              <label for="email" class="form-label text-white" aria-placeholder="Email"
                >Email:</label
              >
              <input
                id="email"
                class="form-control"
                v-model="form.email"
                placeholder="Email"
              />
              <div v-if="errors.email" class="text-warning">
                {{ errors.email }}
              </div>
            </div>

            <div class="mb-3">
              <label
                for="password"
                class="form-label text-white"
                aria-placeholder="Password"
                >Password:</label
              >
              <input
                type="password"
                id="password"
                class="form-control"
                v-model="form.password"
                placeholder="Password"
              />
              <div v-if="errors.password" class="text-warning">
                {{ errors.password }}
              </div>
            </div>

            <button type="submit" class="btn btn-light mt-3">LOGIN</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "../../../Layouts/Layout";
import { Head } from '@inertiajs/inertia-vue';

export default {
  components: {
    Layout,
    Head
  },
  props: {
    errors: Object,
    flash: Object,
  },
  data() {
    return {
      form: {
        email: null,
        password: null,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post("/admin/login", this.form);
    },
  },
};
</script>
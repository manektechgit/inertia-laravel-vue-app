<template>
  <div>
    <Layout></Layout>
    <Head title="New User" />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <form @submit.prevent="submit">
            <div class="mb-3 mt-3">
              <label for="name" class="form-label" aria-placeholder="Name"
                >Name:</label
              >
              <input
                id="name"
                class="form-control"
                v-model="form.name"
                placeholder="Name"
              />
              <div v-if="errors.name" class="text-danger">
                {{ errors.name }}
              </div>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label" aria-placeholder="Email"
                >Email:</label
              >
              <input
                id="email"
                class="form-control"
                v-model="form.email"
                placeholder="Email"
              />
              <div v-if="errors.email" class="text-danger">
                {{ errors.email }}
              </div>
            </div>

            <div class="mb-3">
              <label
                for="password"
                class="form-label"
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
              <div v-if="errors.password" class="text-danger">
                {{ errors.password }}
              </div>
            </div>

            <div class="mb-3">
              <label for="role" class="form-label" aria-placeholder="Role"
                >Role:</label
              >
              <select class="form-control" v-model="form.role">
                <option disabled value="">Please Select</option>
                <option
                  v-for="item in data"
                  :value="item"
                  :key="item.id"
                >
                  {{ item.name }}
                </option>
              </select>
              <div v-if="errors.role" class="text-danger">
                {{ errors.role }}
              </div>
            </div>

            <button type="submit" class="btn btn-primary">SUBMIT</button>
            <Link href="/admin/users">
              <button type="button" class="btn btn-warning">Cancel</button>
            </Link>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "../../../Layouts/Layout";
import { Head, Link } from "@inertiajs/inertia-vue";

export default {
  components: {
    Layout,
    Head,
    Link,
  },
  props: {
    data: Array,
    errors: Object,
  },
  data() {
    return {
      form: {
        name: null,
        email: null,
        password: null,
        role: ''
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post("/admin/users", this.form);
    },
  },
};
</script>
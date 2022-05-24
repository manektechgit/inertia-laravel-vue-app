<template>
  <div>
    <Layout></Layout>
    <Head title="Update User" />
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
                v-model="data.user.name"
                placeholder="Name"
              />
              <div v-if="errors.name" class="text-danger">{{ errors.name }}</div>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label" aria-placeholder="Email"
                >Email:</label
              >
              <input
                id="email"
                class="form-control"
                v-model="data.user.email"
                placeholder="Email"
              />
              <div v-if="errors['user.email']" class="text-danger">{{ errors['user.email'] }}</div>
            </div>

            <div class="mb-3">
              <label for="role" class="form-label" aria-placeholder="Role"
                >Role:</label
              >
              <select class="form-control" v-model="data.userRole.name">
                <option disabled value="">Please Select</option>
                <option
                  v-for="item in data.roles"
                  :value="item.name"
                  :key="item.id"
                  :selected="item.name == data.userRole.name"
                >
                  {{ item.name }}
                </option>
              </select>
              <div v-if="errors.userRole" class="text-danger">
                {{ errors.userRole }}
              </div>
            </div>

            <input class="form-control" hidden v-model="data.user.id" />
            <button type="submit" class="btn btn-primary">UPDATE</button>
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
    Link
  },
  props: {
    data: Object,
    errors: Object
  },
  methods: {
    submit() {
      this.$inertia.post("/admin/users/" + this.data.user.id, this.data);
    },
  },
};
</script>
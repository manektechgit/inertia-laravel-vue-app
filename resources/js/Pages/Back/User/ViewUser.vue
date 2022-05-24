<template>
  <div>
    <Layout></Layout>
    <Head title="View User" />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <form>
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
            </div>

            <div class="mb-3 mt-3">
              <label for="role" class="form-label" aria-placeholder="Role"
                >Role:</label>
                <br />
              <ul class="list-group" v-for="item in data.userRole" v-bind:key="item.id">
                <li> {{ item.name }} </li>
              </ul>
            </div>
            <Link href="/admin/users">
              <button type="button" class="btn btn-warning">Back</button>
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
  },
};
</script>
<template>
  <div>
    <Layout></Layout>
    <Head title="Users" />
    <div class="container">
      <div class="row mt-5">
        <h1>Users List - Frontend</h1>
        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
          <input
            type="text"
            class="form-control"
            v-model="keyword"
            placeholder="Search"
          />
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="row in data.data" v-bind:key="row.id">
                <th scope="row">{{ row.id }}</th>
                <td>{{ row.name }}</td>
                <td>{{ row.email }}</td>
                <td>{{ row.roleName }}</td>
              </tr>
              <tr v-if="data.data.length === 0">
                <td colspan="4" class="text-center">No Record Found!</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <Pagination class="mt-6" :links="data.links" />
    </div>
  </div>
</template>

<script>
import Layout from "../../../Layouts/Layout";
import AlertMessage from "../../../Layouts/AlertMessage";
import Pagination from "../../../Layouts/Pagination";
import pickBy from "lodash/pickBy";
import { Head } from "@inertiajs/inertia-vue";

export default {
  components: {
    Layout,
    AlertMessage,
    Pagination,
    Head
  },
  props: {
    data: Object,
    errors: Object,
    flash: Object,
  },
  data() {
    return {
      keyword: null,
    };
  },
  watch: {
    keyword(after, before) {
      this.$inertia.get("/", pickBy({ keyword: this.keyword }), {
        preserveState: true,
      });
    },
  },
};
</script>
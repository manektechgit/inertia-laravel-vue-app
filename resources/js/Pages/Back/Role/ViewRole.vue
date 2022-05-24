<template>
  <div>
    <Layout></Layout>
    <Head title="View Role" />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <form>
            <div class="mb-3 mt-3">
              <label for="name" class="form-label" aria-placeholder="Name"
                >Role Name:</label
              >
              <input
                id="name"
                class="form-control"
                v-model="data.role.name"
                placeholder="Role Name"
              />
            </div>

            <div class="mb-3 mt-3">
              <label for="permissions" class="form-label" aria-placeholder="Permissions"
                >Permissions:</label>
                <br />
              <ul class="list-group" v-for="item in data.rolePermissions" v-bind:key="item.id">
                <li> {{ item.name }} </li>
              </ul>
            </div>
            <Link href="/admin/roles">
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
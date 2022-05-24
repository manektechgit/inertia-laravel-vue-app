<template>
  <div>
    <Layout></Layout>
    <Head title="Update Role" />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <form @submit.prevent="submit">
            <div class="mb-3 mt-3">
              <label for="name" class="form-label" aria-placeholder="Role Name"
                >Role Name:</label
              >
              <input
                id="name"
                class="form-control"
                v-model="data.role.name"
                placeholder="Role Name"
              />
              <div v-if="errors['role.name']" class="text-danger">
                {{ errors['role.name'] }}
              </div>
            </div>

            <div class="mb-3 mt-3">
              <label
                for="name"
                class="form-label"
                aria-placeholder="Permissions"
                >Permissions:</label
              >
              <br />
              <span v-for="item in data.permission" v-bind:key="item.id">
                <input
                  type="checkbox"
                  :value="item"
                  v-model="data.rolePermissions"
                />
                <span class="checkbox-label"> {{ item.name }} </span> <br />
              </span>
              <div v-if="errors.rolePermissions" class="text-danger">
                {{ errors.rolePermissions }}
              </div>
            </div>

            <input class="form-control" hidden v-model="data.role.id" />
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
    Link,
  },
  props: {
    data: Object,
    errors: Object
  },
  methods: {
    submit() {
      this.$inertia.post("/admin/roles/" + this.data.role.id, this.data);
    }
  },
};
</script>
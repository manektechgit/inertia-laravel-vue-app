<template>
  <div>
    <Layout></Layout>
    <Head title="New Role" />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <form @submit.prevent="submit">
            <div class="mb-3 mt-3">
              <label for="name" class="form-label" aria-placeholder="Role Name"
                >Role Name:</label>
              <input
                id="name"
                class="form-control"
                v-model="form.name"
                placeholder="Role Name"
              />
              <div v-if="errors.name" class="text-danger">
                {{ errors.name }}
              </div>
            </div>

            <div class="mb-3 mt-3">
              <label for="permission" class="form-label" aria-placeholder="Permissions"
                >Permissions:</label>
                <br />
              <span v-for="item in data" v-bind:key="item.id">
                <input
                  type="checkbox"
                  v-model="form.permissions"
                  :value="item"
                />
                <span class="checkbox-label"> {{ item.name }} </span> <br />
              </span>
              <div v-if="errors.permissions" class="text-danger">
                {{ errors.permissions }}
              </div>
            </div>

            <button type="submit" class="btn btn-primary">SUBMIT</button>
            <Link href="/admin/roles">
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
        permissions: []
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post("/admin/roles", this.form);
    },
  },
};
</script>
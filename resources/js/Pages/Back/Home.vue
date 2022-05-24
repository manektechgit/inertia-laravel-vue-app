<template>
  <div>
    <Layout></Layout>
    <Head title="Dashboard" />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <h1 class="text-center">This is Dashboard!</h1>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "../../Layouts/Layout";
import { Head } from "@inertiajs/inertia-vue";

export default {
  components: {
    Layout,
    Head,
  },
};
</script>
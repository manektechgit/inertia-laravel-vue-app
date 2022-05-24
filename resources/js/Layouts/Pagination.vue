<template>
  <div v-if="links.length > 3">
    <div class="pagination pagination-circle">
      <template v-for="(link, key) in links">
        <div
          v-if="link.url === null"
          :key="key"
          class="mr-1 mb-1 px-4 py-3 border rounded"
          v-html="link.label"
        />
        <Link
          v-else
          :key="`link-${key}`"
          class="mr-1 mb-1 px-4 py-3 border rounded"
          :class="{ 'text-gray-500': link.url, 'font-bold': link.active }"
          :href="link.url"
          v-html="link.label"
        />
      </template>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";

export default {
  components: {
    Link,
  },
  props: {
    links: Array,
  },
};
</script>

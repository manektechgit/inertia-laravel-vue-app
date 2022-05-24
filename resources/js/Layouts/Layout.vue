<template>
  <main>
    <header>
      <nav
        id="nav-extra-mb"
        v-if="$page.props.auth.user"
        class="navbar navbar-expand-lg navbar-dark bg-dark"
      >
        <a class="navbar-brand" href="#"
          >Welcome, {{ $page.props.auth.user.name }}!</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <Link class="nav-item nav-link" href="/admin/">Dashboard</Link>
            <Link class="nav-item nav-link" href="/admin/users">Users</Link>
            <Link
              v-if="$page.props.userRoleDetail.roleName !== 'User'"
              class="nav-item nav-link"
              href="/admin/roles"
              >Roles</Link
            >
            <Link class="nav-item nav-link" href="/admin/logout">Logout</Link>
          </div>
        </div>
      </nav>
    </header>
    <article>
      <slot />
    </article>
  </main>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";

export default {
  components: {
    Link,
  },
};
</script>
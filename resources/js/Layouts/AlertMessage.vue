<template>
  <main>
    <content>
      <div v-if="$page.props.flash.message">
        <div
          class="alert alert-success alert-dismissible fade show"
          role="alert"
        >
          {{ $page.props.flash.message }}
          <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
      <slot />
    </content>
  </main>
</template>

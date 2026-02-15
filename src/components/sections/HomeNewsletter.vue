<template>
  <section class="section section-muted">
    <div class="container mx-auto px-4">
      <div class="card p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
          <div class="eyebrow">Stay Updated</div>
          <div class="title">Join our newsletter</div>
          <p class="subtitle mt-2">Get updates on new courses and promotions.</p>
        </div>
        <NewsletterForm />
      </div>
    </div>
  </section>
</template>

<script setup>
import NewsletterForm from "../ui/NewsletterForm.vue"
</script>

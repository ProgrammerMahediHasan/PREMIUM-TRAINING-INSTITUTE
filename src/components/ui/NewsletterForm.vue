<template>
  <form @submit.prevent="submit" class="flex gap-2">
    <input
      v-model="email"
      type="email"
      placeholder="Your email"
      class="flex-1 p-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-secondary"
      required
    />
    <button class="px-4 py-3 rounded-lg bg-secondary text-white hover:bg-secondary-dark">Subscribe</button>
  </form>
  <div v-if="success" class="text-green-500 text-sm mt-2">Subscribed successfully</div>
</template>

<script setup>
import { ref } from "vue"
const email = ref("")
const success = ref(false)
const submit = () => {
  success.value = true
  setTimeout(() => (success.value = false), 3000)
  email.value = ""
}
</script>

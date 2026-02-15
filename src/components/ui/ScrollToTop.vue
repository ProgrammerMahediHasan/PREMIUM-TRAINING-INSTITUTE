<template>
  <button
    v-show="visible"
    class="fixed bottom-6 right-6 p-3 rounded-full bg-primary text-white shadow-lg hover:bg-primary-dark"
    @click="scrollTop"
    aria-label="Scroll to top"
  >
    ↑
  </button>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue"

const visible = ref(false)
const onScroll = () => {
  visible.value = window.scrollY > 300
}
const scrollTop = () => {
  window.scrollTo({ top: 0, behavior: "smooth" })
}
onMounted(() => window.addEventListener("scroll", onScroll))
onBeforeUnmount(() => window.removeEventListener("scroll", onScroll))
</script>

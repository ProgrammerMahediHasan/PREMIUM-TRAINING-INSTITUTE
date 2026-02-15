<template>
  <div>
    <Navbar />
    <transition name="fade" mode="out-in">
      <RouterView />
    </transition>
    <Footer />
    <ScrollToTop />
  </div>
</template>

<script setup>
import { onMounted, watch } from "vue"
import { useRoute } from "vue-router"
import Navbar from "./components/layout/Navbar.vue"
import Footer from "./components/layout/Footer.vue"
import ScrollToTop from "./components/ui/ScrollToTop.vue"
import useSEO from "./composables/useSEO"

const route = useRoute()
const { setTitle, setMeta } = useSEO()

onMounted(() => {
  setTitle(route.meta.title || "PREMIUM — Training Institute")
  setMeta("description", route.meta.description || "Centre for Computer Studies Ltd. offering modern courses and expert instructors.")
})

watch(
  () => route.fullPath,
  () => {
    setTitle(route.meta.title || "PREMIUM — Training Institute")
    setMeta("description", route.meta.description || "Centre for Computer Studies Ltd. offering modern courses and expert instructors.")
  }
)
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.25s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>

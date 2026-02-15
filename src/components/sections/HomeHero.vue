<template>
  <section class="section hero-gradient">
    <div class="container mx-auto px-4 grid md:grid-cols-2 items-center gap-10">
      <div>
        <div class="eyebrow">Welcome to PREMIUM - Training Institute</div>
        <h1 class="text-3xl md:text-5xl font-bold leading-tight mt-2 text-white">Start Learning with Skilled Instructors</h1>
        <p class="mt-4 text-white/80">Modern curriculum, international certificates, and flexible online classes.</p>
        <div class="mt-6 flex items-center gap-3 flex-wrap">
          <input
            v-model="q"
            type="text"
            placeholder="Search courses..."
            class="flex-1 min-w-0 p-3 rounded-lg border border-gray-200 bg-white text-gray-900 placeholder:text-gray-600 focus:outline-none focus:ring-2 focus:ring-primary"
          />
          <Button label="Search" variant="primary" @click="search" class="w-full sm:w-auto" />
          <RouterLink to="/courses" class="w-full sm:w-auto text-center px-5 py-3 rounded-lg border border-white/30 text-white hover:bg-white/10">Browse Courses</RouterLink>
        </div>
        <div class="mt-8 grid grid-cols-3 gap-4">
          <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-primary">50+</div>
            <div class="text-xs text-gray-600">Courses</div>
          </div>
          <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-secondary">20+</div>
            <div class="text-xs text-gray-600">Instructors</div>
          </div>
          <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-primary">5k+</div>
            <div class="text-xs text-gray-600">Students</div>
          </div>
        </div>
      </div>
      <div class="hidden md:block relative">
        <img src="https://images.unsplash.com/photo-1555421481-cc36c2dc5efe?q=80&w=1200&auto=format&fit=crop" alt="" class="rounded-xl shadow-md" />
        <div class="absolute -bottom-4 -left-4 bg-white rounded-xl shadow p-3 text-sm">
          <div class="font-semibold">Live Classes</div>
          <div class="text-gray-600">Join from anywhere</div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from "vue"
import { useRouter } from "vue-router"
import { useCoursesStore } from "../../store/courses"
import Button from "../ui/Button.vue"
const q = ref("")
const router = useRouter()
const store = useCoursesStore()
const search = () => {
  store.setSearch(q.value)
  router.push("/courses")
}
</script>

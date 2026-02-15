<template>
  <section class="section section-muted">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between mb-6">
        <div>
          <div class="eyebrow">Top Picks</div>
          <h2 class="title">Popular Courses</h2>
          <p class="subtitle">Most enrolled and highly rated courses</p>
        </div>
        <RouterLink to="/courses" class="text-primary">View all</RouterLink>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <CourseCard v-for="c in popular" :key="c.id" :course="c" />
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from "vue"
import { useCoursesStore } from "../../store/courses"
import CourseCard from "../ui/CourseCard.vue"
const store = useCoursesStore()
const popular = computed(() => store.courses.slice(0, 6))
</script>

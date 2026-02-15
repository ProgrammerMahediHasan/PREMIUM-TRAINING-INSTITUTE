<template>
  <section class="section">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between mb-6">
        <div>
          <div class="eyebrow">Our Team</div>
          <h2 class="title">Featured Instructors</h2>
          <p class="subtitle">Experienced professionals from industry</p>
        </div>
        <RouterLink to="/instructors" class="text-primary">View all</RouterLink>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <InstructorCard v-for="i in featured" :key="i.id" :instructor="i" />
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from "vue"
import { useCoursesStore } from "../../store/courses"
import InstructorCard from "../ui/InstructorCard.vue"
const store = useCoursesStore()
const featured = computed(() => store.instructors.slice(0, 4))
</script>

<template>
  <main>
    <section class="section hero-gradient text-white">
      <div class="container mx-auto px-4">
        <div class="eyebrow text-white">Our Team</div>
        <h1 class="text-3xl md:text-5xl font-bold leading-tight mt-2">Meet Our Instructors</h1>
        <p class="mt-3 text-white/80">Experienced professionals from industry, dedicated to your growth.</p>
        <div class="mt-8 grid sm:grid-cols-3 gap-4">
          <div class="p-4 rounded-lg border border-white/20 bg-white/5 text-center">
            <div class="text-2xl font-bold text-primary">20+</div>
            <div class="text-xs">Instructors</div>
          </div>
          <div class="p-4 rounded-lg border border-white/20 bg-white/5 text-center">
            <div class="text-2xl font-bold text-secondary">5k+</div>
            <div class="text-xs">Students Mentored</div>
          </div>
          <div class="p-4 rounded-lg border border-white/20 bg-white/5 text-center">
            <div class="text-2xl font-bold text-primary">100%</div>
            <div class="text-xs">Practical Focus</div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-6">
          <div>
            <div class="eyebrow">Featured Faculty</div>
            <h2 class="title">Instructors</h2>
            <p class="subtitle">Connect and learn with experts</p>
          </div>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <InstructorCard v-for="i in instructors" :key="i.id" :instructor="i" />
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { computed } from "vue"
import { useCoursesStore } from "../store/courses"
import InstructorCard from "../components/ui/InstructorCard.vue"
const store = useCoursesStore()
const instructors = computed(() => store.instructors)
</script>

<template>
  <section class="section">
    <div class="container mx-auto px-4">
      <div class="mb-6">
        <div class="eyebrow">Student Success Stories</div>
        <h2 class="title">What Our Learners Say</h2>
        <p class="subtitle">Real feedback from our learners</p>
      </div>
      <TestimonialSlider :testimonials="testimonials" />
    </div>
  </section>
</template>

<script setup>
import { computed } from "vue"
import { useCoursesStore } from "../../store/courses"
import TestimonialSlider from "../ui/TestimonialSlider.vue"
const store = useCoursesStore()
const testimonials = computed(() => store.testimonials)
</script>

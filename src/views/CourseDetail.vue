<template>
  <main class="section">
    <div class="container mx-auto px-4">
      <div v-if="course" class="grid md:grid-cols-2 gap-8">
        <img :src="course.image" alt="" class="rounded-xl shadow-md" />
        <div class="space-y-3">
          <h1 class="title">{{ course.title }}</h1>
          <p class="text-gray-600">{{ course.description }}</p>
          <div class="flex items-center gap-4 text-sm">
            <span>Instructor: {{ course.instructor }}</span>
            <span>Duration: {{ course.duration }}</span>
            <span>Category: {{ course.category }}</span>
          </div>
          <div class="text-2xl font-semibold text-primary">${{ course.price }}</div>
          <button class="btn-primary" @click="enroll">Enroll Now</button>
        </div>
      </div>
      <div v-else class="text-center text-gray-600">Course not found</div>
      <div class="mt-10">
        <h2 class="title mb-4">Related Courses</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <CourseCard v-for="c in related" :key="'rel-' + c.id" :course="c" />
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { computed } from "vue"
import { useRoute, useRouter } from "vue-router"
import { useCoursesStore } from "../store/courses"
import { useCartStore } from "../store/cart"
import CourseCard from "../components/ui/CourseCard.vue"

const store = useCoursesStore()
const route = useRoute()
const router = useRouter()
const cart = useCartStore()
const course = computed(() => store.getCourse(route.params.id))
const related = computed(() => {
  if (!course.value) return store.courses.slice(0, 3)
  return store.courses.filter(c => c.category === course.value.category && c.id !== course.value.id).slice(0, 3)
})
const enroll = () => {
  if (!course.value) return
  cart.addItem(course.value)
  router.push("/checkout")
}
</script>

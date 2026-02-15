<template>
  <div class="card overflow-hidden group hover:shadow-lg transition">
    <div class="relative">
      <img :src="course.image" alt="" class="w-full h-40 object-cover" />
      <span class="absolute top-3 right-3 px-3 py-1 rounded-full bg-primary/90 text-white text-xs shadow">
        ${{ course.price }}
      </span>
    </div>
    <div class="p-4 space-y-3">
      <h3 class="font-semibold group-hover:text-primary transition">{{ course.title }}</h3>
      <p class="text-sm text-gray-600 line-clamp-2">{{ course.description }}</p>
      <div class="flex items-center justify-between text-sm">
        <span>By {{ course.instructor }}</span>
        <span>{{ course.duration }}</span>
      </div>
      <div class="flex items-center gap-2">
        <RouterLink class="btn-primary w-full" :to="`/courses/${course.id}`">View Details</RouterLink>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  course: {
    type: Object,
    required: true
  }
})
</script>

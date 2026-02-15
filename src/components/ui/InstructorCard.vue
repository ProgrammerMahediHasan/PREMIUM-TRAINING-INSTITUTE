<template>
  <div class="card p-4 text-center group">
    <img :src="instructor.image" alt="" class="w-24 h-24 rounded-full mx-auto object-cover" />
    <div class="mt-3 font-semibold">{{ instructor.name }}</div>
    <div class="text-sm text-gray-600">{{ instructor.title }}</div>
    <div class="flex items-center justify-center gap-3 mt-3">
      <a :href="instructor.twitter" target="_blank" class="text-gray-500 group-hover:text-primary transition">T</a>
      <a :href="instructor.linkedin" target="_blank" class="text-gray-500 group-hover:text-primary transition">L</a>
      <a :href="instructor.github" target="_blank" class="text-gray-500 group-hover:text-primary transition">G</a>
    </div>
  </div>
</template>

<script setup>
defineProps({
  instructor: {
    type: Object,
    required: true
  }
})
</script>

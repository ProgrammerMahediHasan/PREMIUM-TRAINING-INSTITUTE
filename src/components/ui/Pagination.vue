<template>
  <div class="flex items-center justify-center gap-2 mt-6">
    <button
      class="px-4 py-2 rounded-lg border border-gray-200 disabled:opacity-50"
      :disabled="page === 1"
      @click="$emit('update:page', page - 1)"
    >
      Prev
    </button>
    <div class="px-4 py-2 rounded-lg bg-gray-100">Page {{ page }} / {{ totalPages }}</div>
    <button
      class="px-4 py-2 rounded-lg border border-gray-200 disabled:opacity-50"
      :disabled="page >= totalPages"
      @click="$emit('update:page', page + 1)"
    >
      Next
    </button>
  </div>
</template>

<script setup>
defineProps({
  page: {
    type: Number,
    required: true
  },
  totalPages: {
    type: Number,
    required: true
  }
})
defineEmits(["update:page"])
</script>

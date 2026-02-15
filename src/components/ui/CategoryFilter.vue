<template>
  <select
    :class="variant === 'hero' ? 'w-full p-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-primary bg-white border-white/30 text-gray-900' : 'w-full p-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary text-gray-900'"
    :value="modelValue"
    @change="$emit('update:modelValue', $event.target.value)"
  >
    <option value="">All Categories</option>
    <option v-for="c in categories" :key="c" :value="c">{{ c }}</option>
  </select>
</template>

<script setup>
defineProps({
  modelValue: {
    type: String,
    default: ""
  },
  categories: {
    type: Array,
    default: () => []
  },
  variant: {
    type: String,
    default: "default"
  }
})
defineEmits(["update:modelValue"])
</script>

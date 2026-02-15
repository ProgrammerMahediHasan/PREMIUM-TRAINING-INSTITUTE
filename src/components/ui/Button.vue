<template>
  <button
    :class="[
      'inline-flex items-center justify-center px-5 py-3 rounded-lg transition-colors',
      variant === 'primary' ? 'bg-primary text-white hover:bg-primary-dark' :
      variant === 'secondary' ? 'bg-secondary text-white hover:bg-secondary-dark' :
      'border border-gray-200 hover:bg-gray-50'
    ]"
    @click="$emit('click')"
  >
    <slot>{{ label }}</slot>
  </button>
</template>

<script setup>
defineProps({
  label: { type: String, default: "" },
  variant: { type: String, default: "solid" }
})
defineEmits(["click"])
</script>

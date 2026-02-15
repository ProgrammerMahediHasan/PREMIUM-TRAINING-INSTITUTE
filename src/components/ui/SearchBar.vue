<template>
  <div class="flex items-center gap-2">
    <input
      class="w-full p-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-primary bg-white border-gray-200 text-gray-900 placeholder:text-gray-600"
      type="text"
      placeholder="Search courses"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <button
      :class="variant === 'hero' ? 'px-4 py-3 rounded-lg border border-white/30 text-white hover:bg-white/10' : 'px-4 py-3 rounded-lg border border-gray-200'"
      @click="$emit('clear')"
    >Clear</button>
  </div>
</template>

<script setup>
defineProps({
  modelValue: {
    type: String,
    default: ""
  },
  variant: {
    type: String,
    default: "default"
  }
})
defineEmits(["update:modelValue", "clear"])
</script>

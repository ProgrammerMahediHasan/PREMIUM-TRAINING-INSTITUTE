<template>
  <div class="card p-6">
    <div class="overflow-hidden">
      <div class="space-y-4">
        <div v-for="(t, i) in testimonials" :key="i" v-show="index === i">
          <p class="text-lg">"{{ t.text }}"</p>
          <div class="mt-3 font-semibold">{{ t.name }}</div>
          <div class="text-sm text-gray-600">{{ t.role }}</div>
        </div>
      </div>
    </div>
    <div class="flex items-center justify-center gap-2 mt-4">
      <button
        v-for="(t, i) in testimonials"
        :key="'dot-' + i"
        class="w-2 h-2 rounded-full"
        :class="index === i ? 'bg-primary' : 'bg-gray-300'"
        @click="index = i"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue"
const props = defineProps({
  testimonials: {
    type: Array,
    default: () => []
  },
  autoplay: {
    type: Boolean,
    default: true
  },
  interval: {
    type: Number,
    default: 4000
  }
})
const index = ref(0)
onMounted(() => {
  if (props.autoplay) {
    setInterval(() => {
      index.value = (index.value + 1) % props.testimonials.length
    }, props.interval)
  }
})
</script>

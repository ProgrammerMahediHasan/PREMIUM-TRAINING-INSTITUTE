<template>
  <div
    class="card p-6 bg-white/90 backdrop-blur rounded-xl shadow-md"
    @mouseenter="pause"
    @mouseleave="resume"
    @touchstart="onTouchStart"
    @touchend="onTouchEnd"
    tabindex="0"
    @keydown.left.prevent="prev"
    @keydown.right.prevent="next"
  >
    <div class="relative overflow-hidden min-h-[220px]">
      <div
        v-for="(slide, i) in slides"
        :key="'slide-'+i"
        :class="[
          'absolute inset-0 transition-all duration-500 ease-out',
          index === i ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'
        ]"
      >
        <div :class="perView === 2 ? 'grid sm:grid-cols-2 gap-6' : 'grid grid-cols-1 gap-6'">
          <div v-for="(t, j) in slide" :key="'t-'+j" class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-full overflow-hidden bg-primary/10 flex items-center justify-center text-primary font-semibold">
              <img v-if="t.image" :src="t.image" alt="" class="w-full h-full object-cover" />
              <span v-else>{{ initials(t.name) }}</span>
            </div>
            <div class="flex-1">
              <div class="text-secondary text-2xl leading-none">“</div>
              <p class="text-lg mt-2"> {{ t.text }} </p>
              <div class="mt-4 flex items-center gap-3">
                <div class="font-semibold">{{ t.name }}</div>
                <div class="text-sm text-gray-600">• {{ t.role }}</div>
              </div>
              <div class="mt-2 flex items-center gap-1 text-secondary">
                <span v-for="s in 5" :key="'star-'+s" :class="s <= (t.rating || 5) ? 'opacity-100' : 'opacity-30'">★</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-6 flex items-center justify-between">
      <button class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50" @click="prev">‹</button>
      <div class="flex items-center justify-center gap-2">
        <button
          v-for="(slide, i) in slides"
          :key="'dot-' + i"
          class="w-2.5 h-2.5 rounded-full ring-2 ring-primary/20"
          :class="index === i ? 'bg-primary' : 'bg-gray-300'"
          @click="index = i"
          :aria-label="'Go to testimonial ' + (i+1)"
        />
      </div>
      <button class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50" @click="next">›</button>
    </div>
    <div class="mt-4 h-1 bg-gray-200 rounded">
      <div class="h-full bg-primary rounded" :style="{ width: progress + '%' }"></div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from "vue"
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
  },
  perViewDesktop: {
    type: Number,
    default: 2
  },
  perViewMobile: {
    type: Number,
    default: 1
  }
})
const index = ref(0)
let timer = null
let progressTimer = null
const progress = ref(0)
const perView = ref(1)
const slides = ref([])
onMounted(() => {
  start()
  updatePerView()
  window.addEventListener("resize", updatePerView)
})
onBeforeUnmount(() => stop())
const updatePerView = () => {
  perView.value = window.innerWidth >= 768 ? props.perViewDesktop : props.perViewMobile
  makeSlides()
}
const makeSlides = () => {
  const arr = [...props.testimonials]
  const chunks = []
  while (arr.length) chunks.push(arr.splice(0, perView.value))
  slides.value = chunks
  index.value = Math.min(index.value, slides.value.length - 1)
}
watch(() => props.testimonials, makeSlides, { immediate: true })
const start = () => {
  if (props.autoplay && props.testimonials.length > 1) {
    stop()
    timer = setInterval(next, props.interval)
    startProgress()
  }
}
const stop = () => {
  if (timer) {
    clearInterval(timer)
    timer = null
  }
  stopProgress()
}
const pause = () => stop()
const resume = () => start()
const next = () => {
  index.value = (index.value + 1) % slides.value.length
  resetProgress()
}
const prev = () => {
  index.value = (index.value - 1 + slides.value.length) % slides.value.length
  resetProgress()
}
const initials = (name = "") => {
  return name
    .split(" ")
    .map(n => n[0])
    .join("")
    .slice(0, 2)
    .toUpperCase()
}
const startProgress = () => {
  stopProgress()
  progress.value = 0
  const step = 100 / (props.interval / 50)
  progressTimer = setInterval(() => {
    progress.value = Math.min(100, progress.value + step)
  }, 50)
}
const stopProgress = () => {
  if (progressTimer) {
    clearInterval(progressTimer)
    progressTimer = null
  }
}
const resetProgress = () => startProgress()
let touchStartX = 0
const onTouchStart = (e) => {
  touchStartX = e.changedTouches[0].clientX
}
const onTouchEnd = (e) => {
  const dx = e.changedTouches[0].clientX - touchStartX
  if (Math.abs(dx) > 40) {
    if (dx < 0) next()
    else prev()
  }
}
</script>

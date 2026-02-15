<template>
  <main>
    <section class="section hero-gradient text-white">
      <div class="container mx-auto px-4 grid md:grid-cols-2 gap-8 items-center">
        <div>
          <div class="eyebrow text-white">Who we are</div>
          <h1 class="text-3xl md:text-5xl font-bold leading-tight mt-2">About PREMIUM - Training Institute</h1>
          <p class="mt-4 text-white/80">
            Centre for Computer Studies Ltd. offers industry-aligned training led by skilled instructors. We equip learners with modern tools, practical projects, and mentorship to build strong portfolios and launch their tech careers.
          </p>
        </div>
        <div class="block">
          <img :src="photoUrl" alt="CCSL training institute — students collaborating in a session" class="rounded-xl shadow-md w-full h-56 sm:h-64 md:h-auto object-cover" />
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-6">
          <div class="card p-6">
            <div class="font-semibold mb-2">Our Mission</div>
            <p class="text-sm text-gray-700">Deliver quality, accessible training that helps learners gain employable skills and confidence for the modern workplace.</p>
          </div>
          <div class="card p-6">
            <div class="font-semibold mb-2">Our Approach</div>
            <p class="text-sm text-gray-700">Hands-on projects, portfolio building, peer collaboration, and mentorship with an emphasis on real-world outcomes.</p>
          </div>
          <div class="card p-6">
            <div class="font-semibold mb-2">Our Promise</div>
            <p class="text-sm text-gray-700">Up-to-date curriculum, supportive community, and practical guidance for continuous career growth.</p>
          </div>
        </div>

        <div ref="statsEl" class="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="card p-5 text-center">
            <div class="text-2xl font-bold text-primary">{{ stats.courses }}+</div>
            <div class="text-xs text-gray-600">Courses</div>
          </div>
          <div class="card p-5 text-center">
            <div class="text-2xl font-bold text-secondary">{{ stats.instructors }}+</div>
            <div class="text-xs text-gray-600">Instructors</div>
          </div>
          <div class="card p-5 text-center">
            <div class="text-2xl font-bold text-primary">{{ stats.students }}+</div>
            <div class="text-xs text-gray-600">Students</div>
          </div>
          <div class="card p-5 text-center">
            <div class="text-2xl font-bold text-secondary">{{ stats.practical }}%</div>
            <div class="text-xs text-gray-600">Practical Focus</div>
          </div>
        </div>

        <div class="mt-10 grid md:grid-cols-2 gap-8">
          <div class="card p-6">
            <div class="font-semibold mb-2">Why choose PREMIUM</div>
            <ul class="text-sm text-gray-700 space-y-2 list-disc list-inside">
              <li>Skilled instructors with real-world experience</li>
              <li>International certificate opportunities</li>
              <li>Flexible online classes</li>
              <li>Career guidance and portfolio support</li>
            </ul>
          </div>
          <div class="card p-6">
            <div class="font-semibold mb-2">What you’ll learn</div>
            <ul class="text-sm text-gray-700 space-y-2 list-disc list-inside">
              <li>Fundamentals to advanced topics across programming and design</li>
              <li>Project-based learning with modern tools</li>
              <li>Best practices, teamwork, and problem solving</li>
              <li>Preparation for interviews and job readiness</li>
            </ul>
          </div>
        </div>

        <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="card p-6 text-center hover:shadow-md transition">
            <div class="text-3xl">🎯</div>
            <div class="font-semibold mt-2">Outcome Focused</div>
            <div class="text-sm text-gray-600 mt-1">Learn by doing with measurable results</div>
          </div>
          <div class="card p-6 text-center hover:shadow-md transition">
            <div class="text-3xl">🤝</div>
            <div class="font-semibold mt-2">Mentorship</div>
            <div class="text-sm text-gray-600 mt-1">Guidance from experienced professionals</div>
          </div>
          <div class="card p-6 text-center hover:shadow-md transition">
            <div class="text-3xl">🧰</div>
            <div class="font-semibold mt-2">Modern Tools</div>
            <div class="text-sm text-gray-600 mt-1">Industry-ready stack and workflows</div>
          </div>
          <div class="card p-6 text-center hover:shadow-md transition">
            <div class="text-3xl">🌐</div>
            <div class="font-semibold mt-2">Flexible Learning</div>
            <div class="text-sm text-gray-600 mt-1">Online classes and self-paced options</div>
          </div>
        </div>

        <div class="mt-10 grid md:grid-cols-2 gap-6">
          <div class="card p-6">
            <div class="font-semibold mb-3">FAQ</div>
            <div v-for="(f,i) in faqs" :key="i" class="border-t first:border-t-0">
              <button class="w-full text-left py-3 font-semibold" @click="toggleFaq(i)">{{ f.q }}</button>
              <div v-if="f.open" class="pb-3 text-sm text-gray-700">{{ f.a }}</div>
            </div>
          </div>
          <div class="card p-6 flex items-center justify-between">
            <div>
              <div class="font-semibold">Ready to start?</div>
              <div class="text-sm text-gray-600">Talk to us and plan your learning path</div>
            </div>
            <RouterLink to="/contact" class="btn-primary">Contact Us</RouterLink>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { ref, onMounted } from "vue"
const statsEl = ref(null)
const photoUrl = ref(new URL("../assets/Premium.png", import.meta.url).href)
const modules = import.meta.glob("../assets/about-photo.*")
onMounted(async () => {
  const keys = Object.keys(modules)
  if (keys.length) {
    try {
      const mod = await modules[keys[0]]()
      photoUrl.value = mod.default || photoUrl.value
    } catch {
      // keep fallback
    }
  }
})
const stats = ref({ courses: 0, instructors: 0, students: 0, practical: 0 })
const targets = { courses: 50, instructors: 20, students: 5000, practical: 100 }
const animateCounters = () => {
  const start = performance.now()
  const duration = 1200
  const step = (now) => {
    const p = Math.min((now - start) / duration, 1)
    stats.value.courses = Math.floor(targets.courses * p)
    stats.value.instructors = Math.floor(targets.instructors * p)
    stats.value.students = Math.floor(targets.students * p)
    stats.value.practical = Math.floor(targets.practical * p)
    if (p < 1) requestAnimationFrame(step)
  }
  requestAnimationFrame(step)
}
onMounted(() => {
  const io = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting) {
      animateCounters()
      io.disconnect()
    }
  }, { threshold: 0.3 })
  if (statsEl.value) io.observe(statsEl.value)
})
const faqs = ref([
  { q: "Which programs are available?", a: "We offer a range of tech programs including web development, design, data skills, and more.", open: false },
  { q: "Do you provide certificates?", a: "Yes, learners can pursue international certificate opportunities based on program selections.", open: false },
  { q: "Are classes flexible?", a: "Yes, we provide online classes with flexible schedules to fit your needs.", open: false }
])
const toggleFaq = (i) => {
  faqs.value[i].open = !faqs.value[i].open
}
</script>

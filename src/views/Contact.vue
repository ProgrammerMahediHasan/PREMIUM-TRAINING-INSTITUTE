<template>
  <main class="section">
    <div class="container mx-auto px-4">
      <div class="grid md:grid-cols-2 gap-8 items-start">
        <div class="p-6 rounded-xl hero-gradient text-white space-y-6">
          <div>
            <div class="eyebrow text-white">Get in touch</div>
            <h1 class="text-2xl md:text-3xl font-bold mt-2">Contact With PREMIUM</h1>
            <p class="text-white/80">We are happy to assist you with any queries</p>
          </div>
          <div class="grid sm:grid-cols-2 gap-4">
            <div class="p-4 rounded-lg border border-white/20 bg-white/5">
              <div class="flex items-center gap-3">
                <span class="w-10 h-10 rounded-full bg-white/10 text-white flex items-center justify-center">☎</span>
                <div class="font-semibold text-white">Phone</div>
              </div>
              <div class="mt-2 text-sm text-white">
                <a href="tel:01711123236" class="underline">01711-123236</a>
              </div>
            </div>
            <div class="p-4 rounded-lg border border-white/20 bg-white/5">
              <div class="flex items-center gap-3">
                <span class="w-10 h-10 rounded-full bg-white/10 text-white flex items-center justify-center">⏰</span>
                <div class="font-semibold text-white">Hours</div>
              </div>
              <div class="mt-2 text-sm text-white">Closed · Opens 8:30 AM Sat</div>
            </div>
            <div class="p-4 rounded-lg border border-white/20 bg-white/5 sm:col-span-2">
              <div class="flex items-center gap-3">
                <span class="w-10 h-10 rounded-full bg-white/10 text-white flex items-center justify-center">✉</span>
                <div class="font-semibold text-white">Email</div>
              </div>
              <div class="mt-2 text-sm text-white">
                <a href="mailto:PREMIUM_tc@yahoo.com" class="underline">PREMIUM_tc@yahoo.com</a> ·
                <a href="mailto:PREMIUM61588@gmail.com" class="underline">PREMIUM61588@gmail.com</a>
              </div>
            </div>
          </div>
          <div class="p-4 rounded-lg border border-white/20 bg-white/5">
            <div class="flex items-center gap-3">
              <span class="w-10 h-10 rounded-full bg-white/10 text-white flex items-center justify-center">📍</span>
              <div class="font-semibold text-white">Address</div>
            </div>
            <div class="mt-2 text-sm text-white">
              Centre for Computer Studies Ltd. (PREMIUM)<br />
              Nizam Shankar Plaza (4th floor), 72 Sat Masjid Road, Dhanmondi, Dhaka-1209
            </div>
            <a
              class="mt-3 inline-flex items-center px-4 py-2 rounded-lg border border-white/30 text-white hover:bg-white/10"
              href="https://www.google.com/maps/search/?api=1&query=Nizam+Shankar+Plaza+72+Sat+Masjid+Road+Dhanmondi+Dhaka-1209"
              target="_blank"
            >View on Map</a>
          </div>
        </div>
        <div>
          <form @submit.prevent="submit" class="card p-6 space-y-4 bg-white">
            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm mb-1">Name</label>
                <input v-model="form.name" type="text" placeholder="Your name" class="w-full p-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary" />
                <div v-if="errors.name" class="text-red-600 text-sm mt-1">{{ errors.name }}</div>
              </div>
              <div>
                <label class="block text-sm mb-1">Email</label>
                <input v-model="form.email" type="email" placeholder="you@example.com" class="w-full p-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary" />
                <div v-if="errors.email" class="text-red-600 text-sm mt-1">{{ errors.email }}</div>
              </div>
              <div class="sm:col-span-2">
                <label class="block text-sm mb-1">Message</label>
                <textarea v-model="form.message" rows="6" placeholder="Write your message..." class="w-full p-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                <div v-if="errors.message" class="text-red-600 text-sm mt-1">{{ errors.message }}</div>
              </div>
            </div>
            <button class="btn-primary">Send Message</button>
            <div v-if="success" class="text-green-600">Message sent successfully</div>
          </form>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { reactive, ref } from "vue"
const form = reactive({ name: "", email: "", message: "" })
const errors = reactive({ name: "", email: "", message: "" })
const success = ref(false)
const validate = () => {
  errors.name = form.name ? "" : "Name is required"
  errors.email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email) ? "" : "Valid email is required"
  errors.message = form.message.length >= 10 ? "" : "Message should be at least 10 characters"
  return !errors.name && !errors.email && !errors.message
}
const submit = () => {
  if (!validate()) return
  success.value = true
  setTimeout(() => (success.value = false), 3000)
  form.name = ""
  form.email = ""
  form.message = ""
}
</script>

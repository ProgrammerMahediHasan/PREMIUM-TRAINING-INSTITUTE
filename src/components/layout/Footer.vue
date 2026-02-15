<template>
  <footer class="bg-gray-900 text-gray-200 mt-10">
    <div class="container mx-auto px-4 py-12 grid md:grid-cols-3 gap-8">
      <div>
        <div class="text-white font-bold text-xl mb-3">PREMIUM — Training Institute</div>
        <p class="text-sm">Centre for Computer Studies Ltd.</p>
        <p class="text-sm mt-1">Nizam Shankar Plaza (4th floor), 72 Sat Masjid Road, Dhanmondi, Dhaka-1209</p>
        <p class="text-sm mt-1">Phone: <a href="tel:01711123236" class="text-secondary">01711-123236</a></p>
        <p class="text-sm mt-1">Hours: Closed · Opens 8:30 AM Sat</p>
        <p class="text-sm mt-1">Email: <a href="mailto:PREMIUM_tc@yahoo.com" class="text-secondary">PREMIUM_tc@yahoo.com</a></p>
        <p class="text-sm mt-1">Email: <a href="mailto:PREMIUM61588@gmail.com" class="text-secondary">PREMIUM61588@gmail.com</a></p>
      </div>
      <div>
        <div class="font-semibold mb-3">Quick Links</div>
        <ul class="space-y-2 text-sm">
          <li><RouterLink to="/courses">Courses</RouterLink></li>
          <li><RouterLink to="/instructors">Instructors</RouterLink></li>
          <li><RouterLink to="/about">About</RouterLink></li>
          <li><RouterLink to="/contact">Contact</RouterLink></li>
        </ul>
      </div>
      <div>
        <div class="font-semibold mb-3">Newsletter</div>
        <NewsletterForm />
      </div>
    </div>
    <div class="border-t border-gray-800">
      <div class="container mx-auto px-4 py-6 text-sm flex justify-between">
        <span>© {{ year }} PREMIUM — Centre for Computer Studies Ltd.</span>
        <span>Made by Mahedi Hasan with Vue 3 </span>
      </div>
    </div>
  </footer>
</template>

<script setup>
import NewsletterForm from "../ui/NewsletterForm.vue"
const year = new Date().getFullYear()
</script>

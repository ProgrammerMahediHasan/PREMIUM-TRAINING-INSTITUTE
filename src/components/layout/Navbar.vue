<template>
  <header class="sticky top-0 z-40 bg-cream text-navy">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between h-16">
        <RouterLink to="/" class="flex items-center gap-3">
          <img :src="logoUrl" alt="PREMIUM - Training Institute" class="h-10 w-auto" />
        </RouterLink>
        <nav class="hidden md:flex items-center gap-6 font-nav">
          <RouterLink class="text-secondary-dark hover:text-secondary font-bold tracking-wide uppercase" to="/">Home</RouterLink>
          <RouterLink class="text-secondary-dark hover:text-secondary font-bold tracking-wide uppercase" to="/about">About</RouterLink>
          <RouterLink class="text-secondary-dark hover:text-secondary font-bold tracking-wide uppercase" to="/courses">Courses</RouterLink>
          <RouterLink class="text-secondary-dark hover:text-secondary font-bold tracking-wide uppercase" to="/instructors">Instructors</RouterLink>
          <RouterLink class="text-secondary-dark hover:text-secondary font-bold tracking-wide uppercase" to="/contact">Contact</RouterLink>
          <div class="relative" ref="trigger">
            <button class="flex items-center gap-2 px-3 py-2 rounded-lg border border-navy/20 hover:bg-cream/60" @click="cartOpen = !cartOpen">
              <span class="font-bold tracking-wide uppercase text-secondary-dark">Cart</span>
              <span class="inline-flex items-center justify-center min-w-[22px] h-6 px-2 rounded-full bg-primary text-white text-xs">{{ itemCount }}</span>
            </button>
            <transition name="fade">
            <div v-if="cartOpen" class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-100" ref="panel">
              <div class="p-3 border-b sticky top-0 bg-white rounded-t-xl">
                <div class="font-semibold">Saved Cart</div>
                <div class="text-xs text-gray-600">Draft items are kept for you</div>
              </div>
              <div class="max-h-64 overflow-auto">
                <div v-if="cart.items.length === 0" class="p-4 text-sm text-gray-600">
                  <div>Your cart is empty</div>
                  <RouterLink to="/courses" class="btn-primary mt-3 inline-block" @click="cartOpen=false">Browse Courses</RouterLink>
                </div>
                <div v-else class="divide-y">
                  <div v-for="i in cart.items" :key="i.id" class="p-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                      <img :src="i.image" alt="" class="w-10 h-10 rounded object-cover" />
                      <div>
                        <div class="text-sm font-medium">{{ i.title }}</div>
                        <div class="text-xs text-gray-600">${{ i.price }} × {{ i.qty }}</div>
                      </div>
                    </div>
                    <div class="flex items-center gap-3">
                      <div class="inline-flex items-center border rounded-lg overflow-hidden">
                        <button class="px-2 py-1 hover:bg-gray-50" @click="cart.dec(i.id)" aria-label="Decrease">−</button>
                        <div class="px-3 py-1 bg-gray-50 text-sm">{{ i.qty }}</div>
                        <button class="px-2 py-1 hover:bg-gray-50" @click="cart.inc(i.id)" aria-label="Increase">+</button>
                      </div>
                      <button class="text-red-600 text-xs" @click="cart.removeItem(i.id)">Remove</button>
                      <div class="text-sm font-semibold">${{ (i.price * i.qty).toFixed(2) }}</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="p-3 border-t">
                <div class="flex items-center justify-between text-sm">
                  <span class="text-gray-700">Subtotal</span>
                  <span class="font-semibold">${{ subtotal.toFixed(2) }}</span>
                </div>
                <div class="mt-3 flex items-center gap-2">
                  <RouterLink to="/checkout" class="btn-primary flex-1 text-center" @click="cartOpen=false">Go to Checkout</RouterLink>
                  <button class="px-3 py-2 rounded-lg border" @click="cart.clear()">Clear</button>
                  <button class="px-3 py-2 rounded-lg border" @click="cartOpen=false">Close</button>
                </div>
              </div>
            </div>
            </transition>
          </div>
        </nav>
        <button class="md:hidden p-2 rounded-lg border border-navy/30 text-navy" @click="open = !open">
          <span v-if="!open">Menu</span>
          <span v-else>Close</span>
        </button>
      </div>
    </div>
    <div v-if="open" class="md:hidden border-t border-navy/10 bg-cream">
      <div class="px-4 py-3 space-y-2 font-nav">
        <RouterLink class="block py-2 text-secondary-dark hover:text-secondary font-bold tracking-wide uppercase" @click="open=false" to="/">Home</RouterLink>
        <RouterLink class="block py-2 text-secondary-dark hover:text-secondary font-bold tracking-wide uppercase" @click="open=false" to="/about">About</RouterLink>
        <RouterLink class="block py-2 text-secondary-dark hover:text-secondary font-bold tracking-wide uppercase" @click="open=false" to="/courses">Courses</RouterLink>
        <RouterLink class="block py-2 text-secondary-dark hover:text-secondary font-bold tracking-wide uppercase" @click="open=false" to="/instructors">Instructors</RouterLink>
        <RouterLink class="block py-2 text-secondary-dark hover:text-secondary font-bold tracking-wide uppercase" @click="open=false" to="/contact">Contact</RouterLink>
        <RouterLink class="block py-2 text-secondary-dark hover:text-secondary font-bold tracking-wide uppercase" @click="open=false" to="/checkout">Cart ({{ itemCount }})</RouterLink>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from "vue"
import { useCartStore } from "../../store/cart"
const open = ref(false)
const cartOpen = ref(false)
const cart = useCartStore()
const itemCount = computed(() => cart.itemCount)
const subtotal = computed(() => cart.subtotal)
const panel = ref(null)
const trigger = ref(null)
const logoUrl = new URL("../../assets/logo.svg", import.meta.url).href

const onDocClick = (e) => {
  if (!cartOpen.value) return
  const path = e.composedPath ? e.composedPath() : []
  if (panel.value && (path.includes(panel.value) || path.includes(trigger.value))) return
  cartOpen.value = false
}
const onKey = (e) => {
  if (e.key === "Escape") cartOpen.value = false
}
onMounted(() => {
  document.addEventListener("click", onDocClick)
  document.addEventListener("keydown", onKey)
})
onBeforeUnmount(() => {
  document.removeEventListener("click", onDocClick)
  document.removeEventListener("keydown", onKey)
})
</script>

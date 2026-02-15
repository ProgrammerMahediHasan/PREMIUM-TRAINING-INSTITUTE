<template>
  <main class="section">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between mb-6">
        <div>
          <div class="eyebrow">Order</div>
          <h1 class="title">Checkout</h1>
          <p class="subtitle">Review your order and complete payment</p>
        </div>
      </div>

      <div v-if="cart.items.length === 0" class="card p-6 text-center">
        <div class="font-semibold mb-2">Your cart is empty</div>
        <p class="text-sm text-gray-600">Browse courses and add to cart to proceed.</p>
        <RouterLink to="/courses" class="btn-primary inline-block mt-4">Browse Courses</RouterLink>
      </div>

      <div v-else class="grid md:grid-cols-3 gap-6">
        <div class="md:col-span-2 space-y-4">
          <div class="card p-4">
            <div class="font-semibold mb-3">Items</div>
            <div class="space-y-3">
              <div v-for="item in cart.items" :key="item.id" class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <img :src="item.image" alt="" class="w-16 h-16 rounded object-cover" />
                  <div>
                    <div class="font-medium">{{ item.title }}</div>
                    <div class="text-sm text-gray-600">${{ item.price }} × {{ item.qty }}</div>
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <div class="inline-flex items-center border rounded-lg overflow-hidden">
                    <button class="px-3 py-2 hover:bg-gray-50" @click="cart.dec(item.id)" aria-label="Decrease">−</button>
                    <div class="px-4 py-2 bg-gray-50">{{ item.qty }}</div>
                    <button class="px-3 py-2 hover:bg-gray-50" @click="cart.inc(item.id)" aria-label="Increase">+</button>
                  </div>
                  <button class="text-red-600" @click="cart.removeItem(item.id)">Remove</button>
                </div>
              </div>
            </div>
          </div>

          <div class="card p-4">
            <div class="font-semibold mb-3">Billing Details</div>
            <div class="grid sm:grid-cols-2 gap-3">
              <div class="space-y-1">
                <input v-model="form.name" type="text" placeholder="Full name *" class="p-3 border rounded w-full" />
                <div v-if="errors.name" class="text-xs text-red-600">{{ errors.name }}</div>
              </div>
              <div class="space-y-1">
                <input v-model="form.email" type="email" placeholder="Email address *" class="p-3 border rounded w-full" />
                <div v-if="errors.email" class="text-xs text-red-600">{{ errors.email }}</div>
              </div>
              <div class="space-y-1 sm:col-span-2">
                <input v-model="form.phone" type="tel" placeholder="Phone number *" class="p-3 border rounded w-full" />
                <div v-if="errors.phone" class="text-xs text-red-600">{{ errors.phone }}</div>
              </div>
            </div>
            <div class="mt-4">
              <div class="font-semibold mb-2">Payment Method</div>
              <div class="grid sm:grid-cols-3 gap-3">
                <button type="button" :class="['p-3 rounded-lg border', form.method==='card' ? 'border-primary ring-2 ring-primary/30' : 'border-gray-200']" @click="form.method='card'">
                  <div class="flex items-center justify-between">
                    <span class="font-medium">Card</span>
                    <span class="text-xs text-gray-600">Visa • Mastercard</span>
                  </div>
                </button>
                <button type="button" :class="['p-3 rounded-lg border', form.method==='bkash' ? 'border-primary ring-2 ring-primary/30' : 'border-gray-200']" @click="form.method='bkash'">
                  <div class="flex items-center justify-between">
                    <span class="font-medium">bKash</span>
                    <span class="text-xs text-gray-600">Mobile Wallet</span>
                  </div>
                </button>
                <button type="button" :class="['p-3 rounded-lg border', form.method==='nagad' ? 'border-primary ring-2 ring-primary/30' : 'border-gray-200']" @click="form.method='nagad'">
                  <div class="flex items-center justify-between">
                    <span class="font-medium">Nagad</span>
                    <span class="text-xs text-gray-600">Mobile Wallet</span>
                  </div>
                </button>
              </div>
            </div>
            <div class="mt-4">
              <div v-if="form.method==='card'" class="grid sm:grid-cols-2 gap-3">
                <div class="space-y-1 sm:col-span-2">
                  <input :value="form.cardNumber" @input="onCardNumber($event.target.value)" inputmode="numeric" maxlength="19" placeholder="Card number *" class="p-3 border rounded w-full" />
                  <div v-if="errors.cardNumber" class="text-xs text-red-600">{{ errors.cardNumber }}</div>
                </div>
                <div class="space-y-1">
                  <input :value="form.expiry" @input="onExpiry($event.target.value)" inputmode="numeric" maxlength="5" placeholder="MM/YY *" class="p-3 border rounded w-full" />
                  <div v-if="errors.expiry" class="text-xs text-red-600">{{ errors.expiry }}</div>
                </div>
                <div class="space-y-1">
                  <input v-model="form.cvv" inputmode="numeric" maxlength="4" placeholder="CVV *" class="p-3 border rounded w-full" />
                  <div v-if="errors.cvv" class="text-xs text-red-600">{{ errors.cvv }}</div>
                </div>
                <div class="space-y-1 sm:col-span-2">
                  <input v-model="form.cardName" type="text" placeholder="Name on card *" class="p-3 border rounded w-full" />
                  <div v-if="errors.cardName" class="text-xs text-red-600">{{ errors.cardName }}</div>
                </div>
              </div>
              <div v-else-if="form.method==='bkash'" class="grid sm:grid-cols-2 gap-3">
                <div class="space-y-1">
                  <input v-model="form.walletNumber" inputmode="tel" maxlength="11" placeholder="bKash number *" class="p-3 border rounded w-full" />
                  <div v-if="errors.walletNumber" class="text-xs text-red-600">{{ errors.walletNumber }}</div>
                </div>
                <div class="space-y-1">
                  <input v-model="form.txnId" placeholder="Transaction ID *" class="p-3 border rounded w-full" />
                  <div v-if="errors.txnId" class="text-xs text-red-600">{{ errors.txnId }}</div>
                </div>
                <div class="sm:col-span-2 text-xs text-gray-600">bKash app theke payment complete kore Transaction ID din.</div>
              </div>
              <div v-else class="grid sm:grid-cols-2 gap-3">
                <div class="space-y-1">
                  <input v-model="form.walletNumber" inputmode="tel" maxlength="11" placeholder="Nagad number *" class="p-3 border rounded w-full" />
                  <div v-if="errors.walletNumber" class="text-xs text-red-600">{{ errors.walletNumber }}</div>
                </div>
                <div class="space-y-1">
                  <input v-model="form.txnId" placeholder="Transaction ID *" class="p-3 border rounded w-full" />
                  <div v-if="errors.txnId" class="text-xs text-red-600">{{ errors.txnId }}</div>
                </div>
                <div class="sm:col-span-2 text-xs text-gray-600">Nagad app theke payment complete kore Transaction ID din.</div>
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-4">
          <div class="card p-4">
            <div class="flex items-center justify-between">
              <span class="text-gray-700">Subtotal</span>
              <span class="font-semibold">${{ cart.subtotal.toFixed(2) }}</span>
            </div>
            <div class="flex items-center justify-between mt-2">
              <span class="text-gray-700">Total</span>
              <span class="font-semibold">${{ cart.total.toFixed(2) }}</span>
            </div>
            <button class="btn-primary w-full mt-4" :disabled="processing || !canPay" @click="pay">
              <span v-if="processing">Processing...</span>
              <span v-else>Pay Now</span>
            </button>
            <div v-if="success" class="text-green-600 text-sm mt-3">Payment successful. Enrollment confirmed.</div>
          </div>
          <div class="text-xs text-gray-600">
            Secure payment is simulated for demo purposes.
          </div>
        </div>
      </div>
    </div>
  </main>
  <div v-if="success" class="fixed inset-0 bg-black/50 flex items-center justify-center">
    <div class="bg-white rounded-xl p-6 w-[90%] max-w-md text-center">
      <div class="text-2xl font-semibold mb-2">Thank you</div>
      <p class="text-gray-600">Your enrollment has been confirmed.</p>
      <div class="mt-4 flex items-center justify-center gap-3">
        <RouterLink to="/courses" class="btn-primary">Continue Browsing</RouterLink>
        <RouterLink to="/" class="border px-5 py-3 rounded-lg">Go Home</RouterLink>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, computed } from "vue"
import { useCartStore } from "../store/cart"

const cart = useCartStore()
const processing = ref(false)
const success = ref(false)

const form = reactive({
  name: "",
  email: "",
  phone: "",
  method: "card",
  cardNumber: "",
  expiry: "",
  cvv: "",
  cardName: "",
  walletNumber: "",
  txnId: ""
})

const errors = reactive({
  name: "",
  email: "",
  phone: "",
  cardNumber: "",
  expiry: "",
  cvv: "",
  cardName: "",
  walletNumber: "",
  txnId: ""
})

const validateBase = () => {
  errors.name = form.name ? "" : "Name is required"
  errors.email = /.+@.+\..+/.test(form.email) ? "" : "Valid email required"
  errors.phone = form.phone && form.phone.length >= 6 ? "" : "Valid phone required"
}

const validateCard = () => {
  const digits = form.cardNumber.replace(/\s/g, "")
  errors.cardNumber = digits.length === 16 ? "" : "16-digit card number"
  errors.expiry = /^\d{2}\/\d{2}$/.test(form.expiry) ? "" : "Format MM/YY"
  errors.cvv = /^\d{3,4}$/.test(form.cvv) ? "" : "3-4 digit CVV"
  errors.cardName = form.cardName ? "" : "Name on card required"
}

const validateWallet = () => {
  errors.walletNumber = /^\d{11}$/.test(form.walletNumber) ? "" : "11-digit number"
  errors.txnId = form.txnId ? "" : "Transaction ID required"
}

const canPay = computed(() => {
  validateBase()
  if (form.method === "card") validateCard()
  else validateWallet()
  return Object.values(errors).every(v => v === "")
})

const pay = () => {
  if (!canPay.value) return
  processing.value = true
  setTimeout(() => {
    processing.value = false
    success.value = true
    cart.clear()
  }, 1200)
}

const onQty = (id, v) => {
  const qty = parseInt(v, 10)
  if (Number.isFinite(qty)) cart.updateQty(id, qty)
}

const onCardNumber = (v) => {
  const digits = v.replace(/\D/g, "").slice(0, 16)
  const parts = []
  for (let i = 0; i < digits.length; i += 4) parts.push(digits.slice(i, i + 4))
  form.cardNumber = parts.join(" ")
}

const onExpiry = (v) => {
  const digits = v.replace(/\D/g, "").slice(0, 4)
  if (digits.length <= 2) form.expiry = digits
  else form.expiry = digits.slice(0, 2) + "/" + digits.slice(2)
}
</script>

import { defineStore } from "pinia"

const persistKey = "premium_cart"

export const useCartStore = defineStore("cart", {
  state: () => ({
    items: (() => {
      try {
        const raw = localStorage.getItem(persistKey)
        return raw ? JSON.parse(raw) : []
      } catch {
        return []
      }
    })()
  }),
  getters: {
    itemCount: (state) => state.items.reduce((sum, i) => sum + i.qty, 0),
    subtotal: (state) => state.items.reduce((sum, i) => sum + i.price * i.qty, 0),
    total() {
      return this.subtotal
    }
  },
  actions: {
    persist() {
      try {
        localStorage.setItem(persistKey, JSON.stringify(this.items))
      } catch {}
    },
    addItem(course) {
      const existing = this.items.find(i => i.id === course.id)
      if (existing) {
        existing.qty += 1
      } else {
        this.items.push({
          id: course.id,
          title: course.title,
          price: course.price,
          image: course.image,
          qty: 1
        })
      }
      this.persist()
    },
    removeItem(id) {
      this.items = this.items.filter(i => i.id !== id)
      this.persist()
    },
    updateQty(id, qty) {
      const item = this.items.find(i => i.id === id)
      if (!item) return
      item.qty = Math.max(1, qty)
      this.persist()
    },
    inc(id) {
      const item = this.items.find(i => i.id === id)
      if (!item) return
      item.qty += 1
      this.persist()
    },
    dec(id) {
      const item = this.items.find(i => i.id === id)
      if (!item) return
      item.qty = Math.max(1, item.qty - 1)
      this.persist()
    },
    clear() {
      this.items = []
      this.persist()
    }
  }
})

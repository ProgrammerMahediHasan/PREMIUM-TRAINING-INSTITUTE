<template>
  <main>
    <section class="section hero-gradient text-black">
      <div class="container mx-auto px-4">
        <div class="eyebrow text-white">Explore Learning</div>
        <h1 class="text-white md:text-5xl font-bold leading-tight mt-2">Courses</h1>
        <p class="mt-3 text-white/80">Browse all courses with search, category filter, and pagination</p>
        <div class="mt-6 grid md:grid-cols-3 gap-4">
          <div class="bg-white/10 rounded-lg p-3">
            <SearchBar v-model="search" @clear="clearSearch" variant="hero" />
          </div>
          <div class="bg-white/10 rounded-lg p-3">
            <CategoryFilter v-model="category" :categories="categories" variant="hero" />
          </div>
          <div class="bg-white/10 rounded-lg p-3 flex items-center justify-center">
            <span class="inline-flex items-center px-3 py-2 rounded-lg border border-white/30 text-sm text-white">Found {{ filtered.length }} courses</span>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container mx-auto px-4">
        <LoadingSpinner v-if="loading" />
        <div v-else class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <CourseCard v-for="c in paginated" :key="c.id" :course="c" />
        </div>
        <Pagination
          class="mt-6"
          :page="page"
          :totalPages="totalPages"
          @update:page="setPage"
        />
      </div>
    </section>
  </main>
</template>

<script setup>
import { ref, computed, onMounted } from "vue"
import { useCoursesStore } from "../store/courses"
import CourseCard from "../components/ui/CourseCard.vue"
import SearchBar from "../components/ui/SearchBar.vue"
import CategoryFilter from "../components/ui/CategoryFilter.vue"
import Pagination from "../components/ui/Pagination.vue"
import LoadingSpinner from "../components/ui/LoadingSpinner.vue"

const store = useCoursesStore()
const loading = ref(true)
const search = computed({
  get: () => store.searchQuery,
  set: (v) => store.setSearch(v)
})
const category = computed({
  get: () => store.selectedCategory,
  set: (v) => store.setCategory(v)
})
const categories = computed(() => store.categories)
const filtered = computed(() => store.filteredCourses)
const paginated = computed(() => store.paginatedCourses)
const page = computed(() => store.page)
const totalPages = computed(() => store.totalPages)
const setPage = (p) => store.setPage(p)
const clearSearch = () => store.clearSearch()

onMounted(() => {
  setTimeout(() => (loading.value = false), 500)
})
</script>

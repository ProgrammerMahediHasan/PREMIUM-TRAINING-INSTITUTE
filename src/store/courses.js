import { defineStore } from "pinia"

export const useCoursesStore = defineStore("courses", {
  state: () => ({
    courses: [
      { id: "vue-basics", title: "Vue 3 Fundamentals", description: "Learn reactivity, Composition API, and component patterns.", category: "Frontend", instructor: "Alice Johnson", duration: "12h", price: 99, image: "https://images.unsplash.com/photo-1515879218367-8466d910aaa4?q=80&w=1200&auto=format&fit=crop" },
      { id: "react-advanced", title: "Advanced React Patterns", description: "Hooks, context, performance and architecture.", category: "Frontend", instructor: "Bob Lee", duration: "14h", price: 129, image: "https://images.unsplash.com/photo-1526378722484-bbf87f2f1cf4?q=80&w=1200&auto=format&fit=crop" },
      { id: "node-api", title: "Node.js API Development", description: "Build RESTful APIs with Express and JWT.", category: "Backend", instructor: "Carla Gomez", duration: "10h", price: 119, image: "https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1200&auto=format&fit=crop" },
      { id: "fullstack-vue", title: "Fullstack Vue + Node", description: "End-to-end app with authentication and CRUD.", category: "Fullstack", instructor: "Alice Johnson", duration: "18h", price: 159, image: "https://images.unsplash.com/photo-1517433456452-f9633a875f6f?q=80&w=1200&auto=format&fit=crop" },
      { id: "tailwind-ui", title: "Tailwind CSS UI", description: "Build modern UIs with utility-first CSS.", category: "Frontend", instructor: "David Park", duration: "8h", price: 79, image: "https://images.unsplash.com/photo-1537432376769-00a5f0f1fca4?q=80&w=1200&auto=format&fit=crop" },
      { id: "typescript", title: "TypeScript Essentials", description: "Type safety for JS apps and libraries.", category: "Programming", instructor: "Bob Lee", duration: "9h", price: 89, image: "https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1200&auto=format&fit=crop" },
      { id: "data-viz", title: "Data Visualization", description: "Charts and dashboards with D3.js.", category: "Data", instructor: "Eva Chen", duration: "11h", price: 119, image: "https://images.unsplash.com/photo-1518623489646-6e0b0a3ce5f2?q=80&w=1200&auto=format&fit=crop" },
      { id: "python-basics", title: "Python for Beginners", description: "Core syntax, OOP, and scripts.", category: "Programming", instructor: "Frank Miller", duration: "12h", price: 99, image: "https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1200&auto=format&fit=crop" },
      { id: "devops", title: "DevOps Foundations", description: "CI/CD, Docker, and cloud basics.", category: "DevOps", instructor: "David Park", duration: "13h", price: 139, image: "https://images.unsplash.com/photo-1556157382-97eda2d62296?q=80&w=1200&auto=format&fit=crop" },
      { id: "ai-intro", title: "Intro to AI", description: "Fundamentals of machine learning and AI.", category: "AI", instructor: "Eva Chen", duration: "15h", price: 149, image: "https://images.unsplash.com/photo-1534759846116-5791a869f663?q=80&w=1200&auto=format&fit=crop" },
      { id: "security", title: "Web Security Basics", description: "OWASP Top 10 and app hardening.", category: "Security", instructor: "Frank Miller", duration: "10h", price: 129, image: "https://images.unsplash.com/photo-1549921296-3b4a6b1738f9?q=80&w=1200&auto=format&fit=crop" },
      { id: "svelte", title: "Svelte Crash Course", description: "Build fast apps with Svelte.", category: "Frontend", instructor: "Carla Gomez", duration: "7h", price: 79, image: "https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1200&auto=format&fit=crop" }
    ],
    instructors: [
      { id: "alice", name: "Alice Johnson", title: "Senior Frontend Engineer", image: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=800&auto=format&fit=crop", twitter: "https://twitter.com", linkedin: "https://linkedin.com", github: "https://github.com" },
      { id: "bob", name: "Bob Lee", title: "Principal Software Engineer", image: "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=800&auto=format&fit=crop", twitter: "https://twitter.com", linkedin: "https://linkedin.com", github: "https://github.com" },
      { id: "carla", name: "Carla Gomez", title: "Backend Instructor", image: "https://images.unsplash.com/photo-1531123414780-f47e52cc252a?q=80&w=800&auto=format&fit=crop", twitter: "https://twitter.com", linkedin: "https://linkedin.com", github: "https://github.com" },
      { id: "david", name: "David Park", title: "DevOps Specialist", image: "https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?q=80&w=800&auto=format&fit=crop", twitter: "https://twitter.com", linkedin: "https://linkedin.com", github: "https://github.com" },
      { id: "eva", name: "Eva Chen", title: "AI Researcher", image: "https://images.unsplash.com/photo-1544005313-ff4e9c2fce8f?q=80&w=800&auto=format&fit=crop", twitter: "https://twitter.com", linkedin: "https://linkedin.com", github: "https://github.com" },
      { id: "frank", name: "Frank Miller", title: "Security Analyst", image: "https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?q=80&w=800&auto=format&fit=crop", twitter: "https://twitter.com", linkedin: "https://linkedin.com", github: "https://github.com" }
    ],
    testimonials: [
      { text: "The courses are well structured and practical.", name: "Sam K.", role: "Student", rating: 5, image: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=200&auto=format&fit=crop" },
      { text: "I landed a job after completing two tracks.", name: "Nina P.", role: "Graduate", rating: 5, image: "https://images.unsplash.com/photo-1544005313-ff4e9c2fce8f?q=80&w=200&auto=format&fit=crop" },
      { text: "Great instructors and supportive community.", name: "Mark D.", role: "Alumni", rating: 4, image: "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=200&auto=format&fit=crop" },
      { text: "High quality curriculum that matches industry needs.", name: "Olivia T.", role: "Student", rating: 5, image: "https://images.unsplash.com/photo-1531123414780-f47e52cc252a?q=80&w=200&auto=format&fit=crop" }
    ],
    searchQuery: "",
    selectedCategory: "",
    page: 1,
    pageSize: 6
  }),
  getters: {
    categories: (state) => {
      const set = new Set(state.courses.map(c => c.category))
      return Array.from(set).sort()
    },
    filteredCourses: (state) => {
      let list = state.courses
      if (state.searchQuery) {
        const q = state.searchQuery.toLowerCase()
        list = list.filter(c =>
          c.title.toLowerCase().includes(q) ||
          c.description.toLowerCase().includes(q) ||
          c.instructor.toLowerCase().includes(q)
        )
      }
      if (state.selectedCategory) {
        list = list.filter(c => c.category === state.selectedCategory)
      }
      return list
    },
    paginatedCourses() {
      const start = (this.page - 1) * this.pageSize
      return this.filteredCourses.slice(start, start + this.pageSize)
    },
    totalPages() {
      return Math.max(1, Math.ceil(this.filteredCourses.length / this.pageSize))
    },
    getInstructor: (state) => (id) => state.instructors.find(i => i.id === id),
    getCourse: (state) => (id) => state.courses.find(c => c.id === id)
  },
  actions: {
    setSearch(v) {
      this.searchQuery = v
      this.page = 1
    },
    clearSearch() {
      this.searchQuery = ""
      this.page = 1
    },
    setCategory(v) {
      this.selectedCategory = v
      this.page = 1
    },
    setPage(p) {
      this.page = p
    }
  }
})

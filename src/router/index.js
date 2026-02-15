import { createRouter, createWebHistory } from "vue-router"

const Home = () => import("../views/Home.vue")
const About = () => import("../views/About.vue")
const Courses = () => import("../views/Courses.vue")
const CourseDetail = () => import("../views/CourseDetail.vue")
const Checkout = () => import("../views/Checkout.vue")
const Instructors = () => import("../views/Instructors.vue")
const Contact = () => import("../views/Contact.vue")
const NotFound = () => import("../views/NotFound.vue")

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", name: "home", component: Home, meta: { title: "Home • PREMIUM", description: "Discover popular courses and featured instructors at PREMIUM." } },
    { path: "/about", name: "about", component: About, meta: { title: "About • PREMIUM", description: "Learn about Centre for Computer Studies Ltd. and our mission." } },
    { path: "/courses", name: "courses", component: Courses, meta: { title: "Courses • PREMIUM", description: "Browse all courses with search, filter, and pagination." } },
    { path: "/courses/:id", name: "course-detail", component: CourseDetail, meta: { title: "Course Detail • PREMIUM", description: "Course details including instructor, duration, and price." } },
    { path: "/checkout", name: "checkout", component: Checkout, meta: { title: "Checkout • PREMIUM", description: "Review your order and complete payment." } },
    { path: "/instructors", name: "instructors", component: Instructors, meta: { title: "Instructors • PREMIUM", description: "Meet our expert instructors and connect on social media." } },
    { path: "/contact", name: "contact", component: Contact, meta: { title: "Contact • PREMIUM", description: "Get in touch with PREMIUM via our contact form." } },
    { path: "/:pathMatch(.*)*", name: "not-found", component: NotFound, meta: { title: "Not Found • PREMIUM", description: "The page you are looking for does not exist." } }
  ],
  scrollBehavior() {
    return { top: 0, behavior: "smooth" }
  }
})

export default router

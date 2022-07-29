import { createWebHistory, createRouter } from "vue-router";
import ProductsList from "@/components/ProductsList.vue"
import LogIn from "@/components/LogIn.vue"
import SubScribe from "@/components/SubScribe.vue"


const routes = [
    {
        path: "/ProductsList",
        name: "ProductsList",
        component: ProductsList
    },
    {
        path: "/LogIn",
        name: "LogIn",
        component: LogIn
    },
    {
        path: "/SubScribe",
        name: "SubScribe",
        component: SubScribe
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
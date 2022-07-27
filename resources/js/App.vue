<script setup>
import {RouterView, useRouter} from 'vue-router'
import Navbar from "@/components/Navbar.vue";
import {useAuthStore} from "@/stores/auth";
import {onMounted} from "vue";

const user = useAuthStore();
const router = useRouter();

onMounted(() => {
    axios.get("auth").then((res) => {
        user.set(res.data);
    }).catch((err) => {
        user.set(null);
        router.push("/login");
    })
});
</script>

<template>
    <Navbar/>
    <main class="xl:px-96 px-12 py-12">
        <RouterView/>
    </main>
</template>

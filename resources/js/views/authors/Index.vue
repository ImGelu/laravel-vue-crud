<script setup>
import {useAuthStore} from "@/stores/auth";
import {RouterLink} from "vue-router";

const user = useAuthStore();
</script>

<template>
    <div class="bg-white rounded-lg shadow-sm p-8">
        Authors
    </div>
</template>

<style scoped>

</style>

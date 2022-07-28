<script setup>
import {useRoute, useRouter} from "vue-router";
import {onMounted, reactive, ref} from "vue";
import LoadingOverlay from "@/components/LoadingOverlay.vue";
import {useAuthorStore} from "@/stores/authors";

const route = useRoute();
const router = useRouter();
const authorStore = useAuthorStore();

const loading = ref(true);

const data = reactive({
    author: {}
});

onMounted(() => {
    authorStore.fetchAuthor(route.params.id).then(() => {
        data.author = authorStore.getAuthor
        loading.value = false;
    }).catch((err) => {
        if (err.response.status === 404) {
            router.push("/authors");
            alert("The Author doesn't exist!");
        }
    })
})

</script>

<template>
    <div class="bg-white rounded-lg shadow-sm p-8 relative">
        <LoadingOverlay v-if="loading"/>
        <h1 class="font-bold text-2xl mb-2">{{ data.author.full_name }}</h1>
        <table class="w-full text-left" v-if="!loading">
            <thead>
            <tr>
                <th scope="col" class="w-24"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-2 text-left font-bold">First Name:</td>
                <td class="py-2 px-2 text-left">{{ data.author.first_name }}</td>
            </tr>
            <tr>
                <td class="py-2 text-left font-bold">Last Name:</td>
                <td class="py-2 px-2 text-left">{{ data.author.last_name }}</td>
            </tr>
            </tbody>
        </table>

        <h2 class="font-bold text-xl my-4">Books written by {{ data.author.full_name }}</h2>
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6 text-center">Book Name</th>
                    <th scope="col" class="py-3 px-6 text-center">Pages</th>
                    <th scope="col" class="py-3 px-6 text-center">Language</th>
                    <th scope="col" class="py-3 px-6 text-center">Price (RON)</th>
                    <th scope="col" class="py-3 px-6 text-center">View Book</th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="book in data.author.books">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 dark:text-white">{{ book.name }}</th>
                    <td class="py-4 px-6 text-center">{{ book.pages }}</td>
                    <td class="py-4 px-6 text-center">{{ book.language }}</td>
                    <td class="py-4 px-6 text-center">{{ book.price }}</td>
                    <td class="py-4 px-6 text-center">
                        <RouterLink :to="`/books/${book.id}`">
                            <button type="button" class="m-1 py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </RouterLink>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

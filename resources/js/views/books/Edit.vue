<script setup>
import {useBookStore} from "@/stores/books";
import {RouterLink, useRoute, useRouter} from "vue-router";
import {onMounted, reactive, ref} from "vue";
import LoadingOverlay from "@/components/LoadingOverlay.vue";
import {useAuthorStore} from "@/stores/authors";

const router = useRouter();
const route = useRoute();
const bookStore = useBookStore();
const authorStore = useAuthorStore();

const loading = ref(true);

const data = reactive({
    book: {
        name: '',
        language: '',
        pages: 0,
        price: 0,
        authors: []
    },
    authors: []
});

onMounted(() => {
    bookStore.fetchBook(route.params.id).then(() => {
        data.book = bookStore.getBook
        data.book.authors = data.book.authors.map((item) => item = item.id);
        loading.value = false;
    }).catch((err) => {
        if(err.response.status === 404){
            router.push("/books");
            alert("The Book doesn't exist!");
        }
    });

    authorStore.fetchAuthors().then(() => {
        data.authors = authorStore.getAuthors
    })
})

const edit = (e) => {
    e.preventDefault();

    bookStore.updateBook(route.params.id, data.book).then(() => {
        alert("Updated Successfully!");
    })
}

</script>

<template>
    <div class="bg-white rounded-lg shadow-sm p-8 relative">
        <LoadingOverlay v-if="loading"/>
        <h1 class="font-bold text-2xl mb-4">Edit Book #{{ data.book.id }}</h1>

        <form>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Title</label>
                <input type="text" v-model="data.book.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Book Name" required>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pages</label>
                <input type="number" v-model="data.book.pages" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pages Number" required>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Language</label>
                <input type="text" v-model="data.book.language" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Book Language" required>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Price (RON)</label>
                <input type="number" v-model="data.book.price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Book Price" required>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Authors</label>
                <v-select v-model="data.book.authors" :options="data.authors" label="full_name" :reduce="(item) => item.id" multiple></v-select>
            </div>
            <button @click="edit" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Book Details</button>
        </form>
    </div>
</template>

<style>
.vs__dropdown-toggle {
    @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-10;
}

.vs__selected, .vs__search {
    @apply !m-0 !text-sm placeholder-gray-500 dark:placeholder-gray-400;
}

.vs__search, .vs__dropdown-option {
    @apply text-gray-900 text-sm dark:placeholder-gray-400 dark:text-white
}

.vs__dropdown-option--highlight {
    @apply !text-white bg-sky-500;
}

.vs__selected-options {
    @apply flex-nowrap gap-1;
}

.vs__dropdown-toggle {
    @apply h-fit;
}

</style>

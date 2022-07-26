<script setup>
import {useBookStore} from "@/stores/books";
import {RouterLink} from "vue-router";
import {onMounted, reactive, ref} from "vue";
import LoadingOverlay from "@/components/LoadingOverlay.vue";

const bookStore = useBookStore();

const loading = ref(true);

const data = reactive({
    list: []
});

onMounted(() => {
    bookStore.fetchBooks().then(() => {
        data.list = bookStore.getBooks
        loading.value = false;
    });
})

const deleteBook = (id) => {
    let canDelete = confirm("Are you sure you want to delete this Book?");

    if(canDelete === true){
        bookStore.deleteBook(id).then(() => {
            data.list = bookStore.getBooks
            alert("The Book has been successfully deleted!");
        })
    }
}

</script>

<template>
    <div class="bg-white rounded-lg shadow-sm p-8 relative">
        <LoadingOverlay v-if="loading"/>
        <div class="text-right">
            <RouterLink to="/books/create">
                <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-4">Add a new Book</button>
            </RouterLink>
        </div>
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6 text-center">Book Name</th>
                    <th scope="col" class="py-3 px-6 text-center">Author(s)</th>
                    <th scope="col" class="py-3 px-6 text-center">Pages</th>
                    <th scope="col" class="py-3 px-6 text-center">Language</th>
                    <th scope="col" class="py-3 px-6 text-center">Price (RON)</th>
                    <th scope="col" class="py-3 px-6 text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="book in data.list">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 dark:text-white">{{ book.name }}</th>
                    <td class="py-4 px-6 text-center">{{ book.authors.map((author) => author.first_name + ' ' + author.last_name).join(', ') }}</td>
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
                        <RouterLink :to="`/books/${book.id}/edit`">
                            <button type="button" class="m-1 py-2 px-3 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>
                        </RouterLink>
                        <button @click="deleteBook(book.id)" type="button" class="m-1 py-2 px-3 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>

</style>

<script setup>
import {useBookStore} from "@/stores/books";
import {useRoute, useRouter} from "vue-router";
import {onMounted, reactive, ref} from "vue";
import LoadingOverlay from "@/components/LoadingOverlay.vue";

const route = useRoute();
const router = useRouter();
const bookStore = useBookStore();

const loading = ref(true);

const data = reactive({
    book: {}
});

onMounted(() => {
    bookStore.fetchBook(route.params.id).then(() => {
        data.book = bookStore.getBook
        loading.value = false;
    }).catch((err) => {
        if(err.response.status === 404){
            router.push("/books");
            alert("The Book doesn't exist!");
        }
    })
})

</script>

<template>
    <div class="bg-white rounded-lg shadow-sm p-8 relative">
        <LoadingOverlay v-if="loading"/>
        <h1 class="font-bold text-2xl mb-2">{{ data.book.name }}</h1>
        <table class="w-full text-left" v-if="!loading">
            <thead>
            <tr>
                <th scope="col" class="w-1"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-2 text-left font-bold">Pages:</td>
                <td class="py-2 px-2 text-left">{{ data.book.pages }}</td>
            </tr>
            <tr>
                <td class="py-2 text-left font-bold">Language:</td>
                <td class="py-2 px-2 text-left">{{ data.book.language }}</td>
            </tr>
            <tr>
                <td class="py-2 text-left font-bold">Price:</td>
                <td class="py-2 px-2 text-left">{{ data.book.price }} RON</td>
            </tr>
            <tr v-if="data.book.authors && data.book.authors.length > 0">
                <td class="py-2 text-left font-bold">Author(s):</td>
                <td class="py-2 px-2 text-left" >{{ data.book.authors.map((author) => author.first_name + ' ' + author.last_name).join(', ') }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>

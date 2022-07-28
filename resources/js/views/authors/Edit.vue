<script setup>
import {useRoute, useRouter} from "vue-router";
import {onMounted, reactive, ref} from "vue";
import LoadingOverlay from "@/components/LoadingOverlay.vue";
import {useAuthorStore} from "@/stores/authors";

const router = useRouter();
const route = useRoute();
const authorStore = useAuthorStore();

const loading = ref(true);

const data = reactive({
    author: {
        first_name: '',
        last_name: '',
    },
    errors: [],
});

onMounted(() => {
    authorStore.fetchAuthor(route.params.id).then(() => {
        data.author = authorStore.getAuthor
        loading.value = false;
    }).catch((err) => {
        if(err.response.status === 404){
            router.push("/authors");
            alert("The Author doesn't exist!");
        }
    });
})

const edit = (e) => {
    e.preventDefault();

    authorStore.updateAuthor(route.params.id, data.author).then(() => {
        alert("Author Updated Successfully!");
        router.push("/authors");
    }).catch((err) => {
        data.errors = [].concat.apply([], Object.values(err.response.data.errors))
    });
}

</script>

<template>
    <div class="bg-white rounded-lg shadow-sm p-8 relative">
        <LoadingOverlay v-if="loading"/>
        <h1 class="font-bold text-2xl mb-4">Edit Author #{{ data.author.id }}</h1>
        <div class="bg-red-200 rounded-lg p-5 my-4" v-if="data.errors.length > 0">
            <ul v-for="error in data.errors">
                <li>{{ error }}</li>
            </ul>
        </div>

        <form>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First Name</label>
                <input type="text" v-model="data.author.first_name" placeholder="First Name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last Name</label>
                <input type="text" v-model="data.author.last_name" placeholder="Last Name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <button @click="edit" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Author Details</button>
        </form>
    </div>
</template>

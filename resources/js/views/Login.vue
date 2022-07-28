<script setup>

import {reactive} from "vue";
import {useRouter} from 'vue-router';
import {useAuthStore} from "@/stores/auth";

const router = useRouter();

const form = reactive({
    email: '',
    password: ''
});

const user = useAuthStore();

const error = reactive({
    value: {
        message: "",
        errors: []
    },
    message: '',
});

const login = (e) => {
    e.preventDefault();

    axios.post('login', form).then((res) => {
        user.set(res.data);
        router.push("/dashboard");
    }).catch((err) => {
        error.value = err.response.data;
    })
}
</script>
<template>
  <div class="bg-white rounded-lg shadow-sm p-8">
      <h1 class="text-xl text-gray-700 uppercase font-bold text-center">Login</h1>

      <div class="bg-red-200 rounded-lg p-5 my-4" v-if="error.value.message.length !== 0">{{error.value.message}}</div>
      <form>
          <div class="mb-6">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
              <input type="email" id="email" v-model="form.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
          </div>
          <div class="mb-6">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
              <input type="password" id="password" v-model="form.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          </div>
          <div class="flex items-start mb-6">
              <div class="flex items-center h-5">
                  <input id="remember" type="checkbox" value="" class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required>
              </div>
              <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
          </div>
          <button @click="login" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </form>
  </div>
</template>

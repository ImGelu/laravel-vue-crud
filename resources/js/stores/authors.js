import {defineStore} from 'pinia'

export const useAuthorStore = defineStore('authors', {
    state: () => {
        return {
            authors: [],
            author: null
        }
    },
    getters: {
        getAuthors: (state) => state.authors,
        getAuthor: (state) => state.author
    },
    actions: {
        async fetchAuthors() {
            const response = await axios.get("authors")
            this.authors = response.data;
        },
        async fetchBook(id) {
            const response = await axios.get(`authors/${id}`)
            this.author = response.data;
        }
    }
})

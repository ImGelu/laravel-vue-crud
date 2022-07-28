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

        async fetchAuthor(id) {
            const response = await axios.get(`authors/${id}`)
            this.author = response.data;
        },

        async updateAuthor(id, data) {
            const response = await axios.put(`authors/${id}`, data)
            const returnedAuthor = response.data;

            const foundIndex = this.authors.findIndex((author) => author.id === returnedAuthor.id);
            this.authors[foundIndex] = returnedAuthor;

            this.author = returnedAuthor;
        },

        async createAuthor(data) {
            const response = await axios.post(`authors`, data)
            this.authors.push(response.data);
        },

        async deleteAuthor(id) {
            const response = await axios.delete(`authors/${id}`)
            this.authors = this.authors.filter((author) => author.id !== response.data.id);
        }
    }
})

import {defineStore} from 'pinia'

export const useBookStore = defineStore('books', {
    state: () => {
        return {
            books: [],
            book: null
        }
    },
    getters: {
        getBooks: (state) => state.books,
        getBook: (state) => state.book
    },
    actions: {
        async fetchBooks() {
            const response = await axios.get("books")
            this.books = response.data;
        },
        async fetchBook(id) {
            const response = await axios.get(`books/${id}`)
            this.book = response.data;
        }
    }
})

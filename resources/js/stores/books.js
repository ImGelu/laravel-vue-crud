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
        },

        async updateBook(id, data) {
            const response = await axios.put(`books/${id}`, data)
            const returnedBook = response.data;

            const foundIndex = this.books.findIndex((book) => book.id === returnedBook.id);
            this.books[foundIndex] = returnedBook;

            this.book = returnedBook;
        },

        async createBook(data) {
            const response = await axios.post(`books`, data)
            this.books.push(response.data);
        },

        async deleteBook(id) {
            const response = await axios.delete(`books/${id}`)
            this.books = this.books.filter((book) => book.id !== response.data.id);
        }
    }
})

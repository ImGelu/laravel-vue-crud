import {defineStore} from 'pinia'

export const useAuthStore = defineStore('auth', {
    state: () => {
        return {
            user: null
        }
    },
    getters: {
        getUser: (state) => state.user
    },
    actions: {
        set(user) {
            this.user = user;
        }
    }
})

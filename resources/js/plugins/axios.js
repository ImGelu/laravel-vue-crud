import axios from "axios";

axios.defaults.baseURL = "/api/v1/";

axios.interceptors.request.use(
    function (config) {
        return config;
    },
    function (error) {
        return Promise.reject(error);
    }
);

axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        const { status, config } = error.response;

        if (status === 401 && config.url !== 'auth') {
            window.location = '/';
        }

        return Promise.reject(error);
    }
);

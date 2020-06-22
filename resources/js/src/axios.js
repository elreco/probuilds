// axios
import axios from 'axios'
import router from './router'

const domain = 'https://api.moi.elreco.fr/'
axios.defaults.baseURL = domain;

axios.interceptors.response.use(function (response) {
    // Do something with response data
    return response;
}, function (error) {
    // Do something with response error
    return router.push({
        name: "page-error",
        params: {
            code: error.response.status,
            message: error.response.data.message
        }
    });
});

export default axios

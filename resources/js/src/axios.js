// axios
import axios from 'axios'
import router from './router'

const domain = process.env.MIX_API_DOMAIN;
axios.defaults.baseURL = domain;

axios.interceptors.response.use(function (response) {
    // Do something with response data
    return response;
}, function (error) {
    // Do something with response error
    if (router.currentRoute.name != "page-error") {
        return router.push({
            name: "page-error",
            params: {
                code: error.response.status,
                message: error.response.data.message
            }
        });
    }

});

export default axios

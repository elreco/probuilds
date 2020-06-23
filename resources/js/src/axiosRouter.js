// axios
import axios from 'axios'

const domain = process.env.MIX_API_DOMAIN
axios.defaults.baseURL = domain;

export default axios

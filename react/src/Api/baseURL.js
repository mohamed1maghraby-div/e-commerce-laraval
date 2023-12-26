import axios from "axios";

const baseUrl = axios.create({baseURL: 'http://ecommerce.test'})

export default baseUrl;
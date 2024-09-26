//import axios
import axios from 'axios';

const Api = axios.create({
    //set default endpoint API
    //baseURL: 'http://localhost:8000'
    baseURL: 'http://localhost/iain-vadr/public'
})

export default Api
// auth.js
import axios from 'axios';

const Auth = {
    check() {
        return axios.get('/api/user')
            .then(response => {
                return response.data !== null;
            })
            .catch(error => {
                console.log("Error checking authentication: ", error);
                return false;
            });
    }
};

export default Auth;

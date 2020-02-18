import axios from 'axios';

export default {
    all() {
        return axios.get('/api/movies');
    },
    find(id) {
        return axios.get(`/api/movies/${id}`);
    },
    update(id, data) {
        return axios.put(`/api/movies/${id}`, data);
    },
    delete(id, data) {
        return axios.delete(`/api/movies/${id}`, data);
    },
};
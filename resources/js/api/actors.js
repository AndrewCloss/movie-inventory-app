import axios from 'axios';

export default {
    all() {
        return axios.get('/api/actors');
    },
    find(id) {
        return axios.get(`/api/actors/${id}`);
    },
    update(id, data) {
        return axios.put(`/api/actors/${id}`, data);
    },
    delete(id, data) {
        return axios.delete(`/api/actors/${id}`, data);
    },
};
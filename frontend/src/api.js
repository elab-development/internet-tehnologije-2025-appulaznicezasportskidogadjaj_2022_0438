import axios from 'axios'

const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api'

const api = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  }
})

// token
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token')
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  },
  (error) => Promise.reject(error)
)

// response greske
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      window.location.href = '/login'
    }
    return Promise.reject(error)
  }
)

// endpoints
export const endpoints = {
  auth: {
    register: (data) => api.post('/register', data),
    login: (data) => api.post('/login', data),
    logout: () => api.post('/logout'),
    me: () => api.get('/me'),
  },
  events: {
    list: () => api.get('/sportskidogadjaji'),
    get: (id) => api.get(`/sportskidogadjaji/${id}`),
    create: (data) => api.post('/sportskidogadjaji', data),
    update: (id, data) => api.put(`/sportskidogadjaji/${id}`, data),
    delete: (id) => api.delete(`/sportskidogadjaji/${id}`),
  },
  tickets: {
    list: () => api.get('/ulaznice'),
    get: (id) => api.get(`/ulaznice/${id}`),
    create: (data) => api.post('/ulaznice', data),
    update: (id, data) => api.put(`/ulaznice/${id}`, data),
    delete: (id) => api.delete(`/ulaznice/${id}`),
  },
  categories: {
    list: () => api.get('/kategorijeulaznica'),
    get: (id) => api.get(`/kategorijeulaznica/${id}`),
  },
  teams: {
    list: () => api.get('/timovi'),
    get: (id) => api.get(`/timovi/${id}`),
  },
}

export default api

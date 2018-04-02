import Vue from 'vue'
import VueResource from 'vue-resource'
import { getToken } from '../utils/auth'

Vue.use(VueResource)

/* fetch all Schools function via api */
export const getSchools = () => {
  return Vue.http.get('/api/schools', { params: { 'token': getToken() }} )
}

/* fetch single School function via api */
export const getSchool = (_id) => {
  return Vue.http.get('/api/school/info', { params: { 'id': _id, 'token': getToken() }} )
}

/* save Schools through the api */
export const saveSchool = () => {
  return Vue.http.post('/api/school', { params: { 'token': getToken() }} )
}

/* save edits of Schools through the api */
export const saveEditSchool = () => {
  return Vue.http.put('/api/school', { params: { 'token': getToken() }} )
}

/* delete a Schools through the api */
export const deleteSchool = (_id) => {
  return Vue.http.delete('/api/school', { params: { 'id': _id, 'token': getToken() }} )
}

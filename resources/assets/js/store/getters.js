const getters = {
  sidebar: state => state.app.sidebar,
  token: state => state.user.token,
  avatar: state => state.user.avatar,
  name: state => state.user.username,
  roles: state => state.user.roles,
  school: state => state.user.school,
  teachers: state => state.user.teachers
}
export default getters

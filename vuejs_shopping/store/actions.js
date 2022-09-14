export const loginUser = ({ commit }, user) => {
  console.log('123');
  this.$axios.post('login', { data: user }).then(res => {
    commit('LOGIN_USER', res.data);
  })
}

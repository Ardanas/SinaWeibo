export default {
    login(state, payload) {
        //将用户状态保存到sessionStorage
        sessionStorage.setItem('userInfo', JSON.stringify(payload));
        state.userInfo = payload;
    },
    logout(state) {
        //清空sessionStorage
        sessionStorage.setItem('userInfo', null);
        state.userInfo = null;
    }
}
const user = {
    state: {
        isDoRefreshToken: false
    },
    mutations: {
        setIsDoRefreshToken(state, status) {
            state.isDoRefreshToken = status
        }
    }
};

export default user
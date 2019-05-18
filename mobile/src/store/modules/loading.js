const loading = {
    state : {
        status: false
    },
    mutations: {
        showLoading(state, status) {
            state.status = status
        }
    }
}

export default loading
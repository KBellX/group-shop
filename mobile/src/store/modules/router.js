const router = {
    state: {
        status: true,
        jumpType: 0
    },
    mutations: {
        setIsRouterAlive(state, status) {
            state.status = status
        },
        setJumpType(state, type) {
            state.jumpType = type
        }
    },
}

export default router
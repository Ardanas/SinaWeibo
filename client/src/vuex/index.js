import Vue from 'vue'
import Vuex from 'vuex'

import state from './state'
import mutations from './mutations'
import actions from './actions'

Vue.use(Vuex)
//热重载方法
export default () => {
    const store = new Vuex.Store({
        state,
        mutations,
        actions
    })

    if (module.hot) {
        // 使 action 和 mutation 成为可热重载模块
        module.hot.accept([
            './state',
            './mutations',
            './actions'
        ], () => {
            const newState = require('./state').default
            const newMutations = require('./mutations').default
            const newActions = require('./actions').default

            store.hotUpdate({
                state: newState,
                mutations: newMutations,
                actions: newActions
            })
        })
    }
    return store
}


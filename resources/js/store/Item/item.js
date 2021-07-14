import axios from "axios";

const baseURL = "/api/v1/item";

const apiResource = {
    index: "getItems"
};

const state = {
    all_items: [],
    items: [],
    item: {},
    item_loading: false,
};

const actions = {
    async getAllItems({ commit }) {
        let status = 'ALL'
        const { data } = await axios.get(`${baseURL}?status=${status}`).then(data => {
            return data;
        });
        commit("SET_GET_ALL_ITEMS", data);
    },
    async getItems({ commit }, payload) {
        let page = payload && payload.page != null ? payload.page : payload;
        let limit = payload && payload.limit != null ? payload.limit : 15;
        let search = payload && payload.search != null ? payload.search : "";
        commit("SET_ITEM_LOADING", true);
        const { data } = await axios
            .get(`${baseURL}?page=${page}&limit=${limit}&search=${search}`)
            .then(data => {
                commit("SET_ITEM_LOADING", false);
                return data;
            });
        commit("SET_GET_ITEMS", data);
    },
    async getItem({ commit, dispatch }, payload) {
        const { data } = await axios.get(`${baseURL}/${payload}`, payload);
        dispatch(apiResource.index);
        commit("SET_GET_ITEM", data);
        return data;
    },
    async createItem({ commit, dispatch }, payload) {
        const { data } = await axios.post(baseURL, payload);
        commit("SET_SAVE_ITEM", data);
        dispatch(apiResource.index);
        return data.message;
    },
    async updateItem({ commit, dispatch }, payload) {
        console.log(payload)
        const { data } = await axios.put(`${baseURL}/${payload.id}`, payload);
        commit("SET_UPDATE_ITEM", data);
        dispatch(apiResource.index);
        return data.message;
    },
    async deleteItem({ commit, dispatch }, payload) {
        const { data } = await axios.delete(`${baseURL}/${payload}`, payload);
        commit("SET_DELETE_ITEM", data);
        dispatch(apiResource.index);
        return data.message;
    },

    async restoreItem({ commit, dispatch }, payload) {
        const { data } = await axios.get(`${baseURL}/restore/${payload}`);
        commit("SET_RESTORE_ITEM", data);
        dispatch(apiResource.index);
        return data.message;
    },
    
};

const mutations = {
    SET_GET_ALL_ITEMS(state, data) {
        state.all_items = data.data;
    },
    SET_GET_ITEMS(state, data) {
        state.items = data.data;
    },
    SET_GET_ITEM(state, data) {
        state.item = data.data;
    },
    SET_SAVE_ITEM(state, data) {
        state.item = data;
    },
    SET_UPDATE_ITEM(state, data) {
        state.item = data.data;
    },
    SET_RESTORE_ITEM(state, data) {
        state.item = data;
    },
    SET_DELETE_ITEM(state, data) {
        state.item = data;
    },
    SET_ITEM_LOADING(state, data) {
        state.item_loading = data;
    },
   
};

const getters = {
    all_items(state) {
        return state.all_items;
    },
    items(state) {
        return state.items.data;
    },
    item(state) {
        return state.item;
    },
   
    is_item_loading(state) {
        return state.item_loading;
    },
    current_page_item(state) {
        return state.items.current_page_item;
    },
   
};

export default {
    state,
    mutations,
    getters,
    actions
};

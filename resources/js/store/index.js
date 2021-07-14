import Vue from "vue";
import Vuex from "vuex";

import Item from "./Item/item";
Vue.use(Vuex);
export default new Vuex.Store({
    modules: {
      Item
    }
});

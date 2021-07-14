<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <b-navbar-brand href="#">TO-DO List</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav> </b-collapse>
    </b-navbar>
    <div class="content-wrapper">
      <div class="slot-container">
        <slot></slot>
      </div>
    </div>
  </div>
</template>


<script>
import Footer from "./Footer.vue";
import { mapActions, mapGetters } from "vuex";
export default {
  name: "TODOLIST",
  components: { Footer },
  props: {},
  data() {
    return {};
  },
  methods: {
    ...mapActions({}),
  },
  computed: { ...mapGetters([""]) },
  mounted() {},
};
</script>

<style scoped>
.fluid-container.footer {
  background: rgb(23, 162, 184);
}
.fluid-container.footer > *:last-child {
  margin-bottom: 0px;
  color: #fff;
}
</style>
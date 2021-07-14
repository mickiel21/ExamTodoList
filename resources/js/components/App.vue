<template>
  <div id="app" class="container-fluid text-center">
    <h1 class="text-info">{{ title }}</h1>
    <p>{{ details }}</p>

    <div class="col">
      <div v-if="error" class="alert alert-danger" @click="error = !error">
        <strong>Error:</strong> Please add the task name first!
      </div>

      <div class="input-group mb-3">
        <input
          type="text"
          class="form-control"
          placeholder="Search"
          v-model="filter"
        />
        <div class="input-group-append">
          <button class="btn btn-warning" type="button" @click="search">
            Search
          </button>
        </div>
      </div>
      <div class="input-group mb-3">
        <input
          type="text"
          class="form-control"
          placeholder="Task Name"
          v-model="form.name"
        />
        <div class="input-group-append">
          <button
            v-if="!updateData"
            class="btn btn-warning"
            type="button"
            @click="save"
          >
            Add
          </button>
          <button
            v-else
            class="btn btn-success"
            type="button"
            @click="updateForm"
          >
            Update
          </button>
        </div>
      </div>

      <button
        v-if="deleteMultiple"
        class="btn btn-danger mb-3"
        type="button"
        @click="destroyMultiple"
      >
        Delete Selected
      </button>

      <ul class="list-group">
        <li
          v-for="item in items"
          :key="item.id"
          class="list-group-item list-group-item-info"
        >
          <div class="row">
            <div class="col-2">
              <label for="">{{ item.id }}</label>
            </div>
            <div class="col" @click="edit(item.id)">{{ item.name }}</div>
            <div class="col">
              {{ item.is_completed ? "DONE" : "NOT YET DONE" }}
            </div>
            <button
              v-if="item.deleted_at == null"
              class="btn btn-danger col"
              type="button"
              @click="confirmDelete(item)"
            >
              Delete
            </button>
            <button
              v-else
              class="btn btn-success col"
              type="button"
              @click="confirmRestore(item)"
            >
              Restore
            </button>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
  name: "TODOLIST",
  components: {},
  props: {},
  data() {
    return {
      title: "TO-DO List",
      details: "Welcome to your first ToDo List App",
      error: false,
      deleteMultiple: false,
      filter: "",
      updateData: false,
      form: {
        id: "",
        name: "",
        completed: true,
      },
    };
  },
  methods: {
    ...mapActions({
      index: "getItems",
      show: "getItem",
      store: "createItem",
      update: "updateItem",
      delete: "deleteItem",
      restore: "restoreItem",
    }),
    save() {
      if (this.form.name.length == 0) {
        this.error = true;
        return;
      }
      this.$swal({
        title: "Saving",
        html: '<img src="/images/loading.png" style="width: 8rem"/>',
        showConfirmButton: false,
        allowOutsideClick: false,
      });
      this.store(this.form)
        .then((response) => {
          this.$swal({
            title: "Add TODO",
            text: "TODO  Successfully Created!",
            icon: "success",
            showCloseButton: true,
            showCancelButton: false,
            confirmButtonText: "OK",
          });
        })
        .catch((errors) => {
          this.$swal({
            title: "Error",
            text: errors,
            icon: "error",
            confirmButtonText: "OK",
          });
        });
    },
    edit(id) {
      this.form.id = id;
      this.show(id).then((response) => {
        this.form.name = response.data.name;
        this.updateData = true;
      });
    },
    confirmDelete(data) {
      this.$swal({
        title: "Delete",
        text: `Do you really want to Delete TO-DO ${data.name}?`,
        icon: "question",
        showCloseButton: true,
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Yes",
        confirmButtonColor: "#3098D5",
        cancelButtonColor: "#F4C014",
      }).then((response) => {
        if (response.value == true) {
          this.delete(data.id).then(
            (response) => {
              this.$swal({
                title: "Success",
                text: response,
                icon: "success",
                confirmButtonText: "OK",
              });
            },
            (errors) => {
              this.$swal({
                title: "Error",
                text: errors.response.data.message,
                icon: "error",
                confirmButtonText: "OK",
              });
            }
          );
        }
      });
    },
    destroyMultiple() {},
    updateForm() {
      if (this.form.name.length == 0) {
        this.error = true;
        return;
      }
      this.$swal({
        title: "Updating",
        html: '<img src="/images/loading.png" style="width: 8rem"/>',
        showConfirmButton: false,
        allowOutsideClick: false,
      });
      this.update(this.form)
        .then((response) => {
          this.$swal({
            title: "Add TODO",
            text: "TODO  Successfully Updated!",
            icon: "success",
            showCloseButton: true,
            showCancelButton: false,
            confirmButtonText: "OK",
          });
        })
        .catch((errors) => {
          this.$swal({
            title: "Error",
            text: errors,
            icon: "error",
            confirmButtonText: "OK",
          });
        });
    },
    confirmRestore(data) {
      this.$swal({
        title: "Restore",
        text: `Do you really want to Restore TO-DO ${data.name}?`,
        icon: "question",
        showCloseButton: true,
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Yes",
        confirmButtonColor: "#3098D5",
        cancelButtonColor: "#F4C014",
      }).then((response) => {
        if (response.value == true) {
          this.restore(data.id).then(
            (response) => {
              this.$swal({
                title: "Success",
                text: response,
                icon: "success",
                confirmButtonText: "OK",
              });
            },
            (errors) => {
              this.$swal({
                title: "Error",
                text: errors.response.data.message,
                icon: "error",
                confirmButtonText: "OK",
              });
            }
          );
        }
      });
    },
    search() {
      this.index({ search: this.filter });
    },
  },
  computed: { ...mapGetters(["items"]) },
  mounted() {
    this.index();
  },
  watch: {
    "form.name": function (newVal) {
      if (newVal.length == 0) {
        this.error = true;
      } else {
        this.error = false;
      }
    },
    filter: function (newVal) {
      if (newVal.length == 0) {
        this.index();
      }
    },
  },
};
</script>

<style scoped>
.margin-top {
  margin-top: 50px;
}
</style>

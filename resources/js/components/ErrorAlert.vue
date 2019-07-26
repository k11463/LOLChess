<template>
  <div class="bg">
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary"
      id="errorBtn"
      data-toggle="modal"
      data-target="#errorModalCenter"
    >Launch demo modal</button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="errorModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
      @click="CloseAlert(false)"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">錯誤訊息</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="CloseAlert(false)"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div
              class="alert alert-danger"
              role="alert"
              v-for="(error, id) in errors"
              :key="id"
            >{{ error }}</div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="CloseAlert(false)"
            >Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["errors", "openAlert"],
  data() {
    return {};
  },
  methods: {
    CloseAlert(val) {
      this.$emit("closeAlert", val);
    }
  },
  watch: {
    openAlert() {
      if (this.openAlert) {
        document.getElementById("errorBtn").click();
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.bg {
  position: absolute;
  top: -100%;
}
</style>


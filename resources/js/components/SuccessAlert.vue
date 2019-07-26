<template>
  <div class="bg">
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary"
      id="successBtn"
      data-toggle="modal"
      data-target="#successModalCenter"
    >Launch demo modal</button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="successModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">{{ title }}成功</h5>
          </div>
          <div class="modal-body">
            <div class="spinner-border text-success" role="status">
              <span class="sr-only"></span>
            </div>
            {{ time }}秒後跳轉
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-success"
              data-dismiss="modal"
              @click="ChangeUrl(url)"
            >馬上跳轉</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["openAlert", "title", "url"],
  data() {
    return {
      time: 5,
      interval: null
    };
  },
  methods: {
    ChangeUrl(url) {
      window.clearInterval(this.interval);
      window.location.href = localStorage.getItem("index") + url;
    }
  },
  watch: {
    openAlert() {
      if (this.openAlert) {
        document.getElementById("successBtn").click();

        this.interval = window.setInterval(() => {
          this.time--;
          if (this.time == 0) {
            window.clearInterval(this.interval);
            window.location.href = localStorage.getItem("index") + this.url;
          }
        }, 1000);
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.bg {
  position: absolute;
  top: -100%;
  .modal-title {
    font-weight: bold;
    color: rgb(20, 107, 20);
  }
  .modal-body {
    display: flex;
    align-items: center;
    font-size: 18px;
    font-weight: bold;
    color: rgb(20, 107, 20);
    div {
      margin-right: 12px;
    }
  }
}
</style>


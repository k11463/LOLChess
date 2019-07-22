<template>
  <div class="row bgBox">
    <div class="col-lg-2 bg" :class="{bg_open: !switchStatus}">
      <span class="boxSwitch" @click="switchStatus = !switchStatus">
        <img :src="boxSwitchImgUrl" alt />
      </span>
      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button
                class="btn btn-link"
                type="button"
                data-toggle="collapse"
                data-target="#collapseOne"
              >會員登入</button>
            </h2>
          </div>

          <div
            id="collapseOne"
            class="collapse show"
            aria-labelledby="headingOne"
            data-parent="#accordionExample"
          >
            <div class="card-body">
              <form>
                <div class="form-group">
                  <label for="exampleInputEmail1">帳號Account</label>
                  <input
                    type="account"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    placeholder="Enter account"
                  />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">密碼Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="exampleInputPassword1"
                    placeholder="Password"
                  />
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                  <label class="form-check-label" for="exampleCheck1">記住帳號remenber account</label>
                </div>
                <button type="submit" class="btn btn-primary">登入login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      switchStatus: true
    };
  },
  computed: {
    boxSwitchImgUrl() {
      return this.switchStatus
        ? "/images/Lock_open.jpg"
        : "/images/Lock_close.jpg";
    }
  }
};
</script>


<style lang="scss" scoped>
* {
  font-family: "標楷體";
  user-select: none;
}
.bg {
  border: 1px solid rgb(165, 165, 165);
  height: 80vh;
  min-height: 680px;
  margin-top: 80px;
  box-shadow: -2px 4px 6px 0px rgba($color: #000000, $alpha: 0.4);
  position: relative;
  transform: translateX(0%);
  transition: 0.8s;
  .boxSwitch {
    width: 52px;
    height: 52px;
    left: 100%;
    bottom: 50%;
    border: 1px solid rgb(172, 172, 172);
    z-index: 1;
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    img {
      width: 100%;
    }
  }
  .accordion {
    z-index: 0;
    width: 105%;
    .card-header {
      background-color: rgb(255, 247, 210);
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      button {
        font-size: 20px;
        letter-spacing: 8px;
        color: rgb(216, 183, 121);
        font-weight: bold;
        outline: none;
        border: none;
        text-decoration: none;
      }
      button:hover {
        border: none;
        text-decoration: none;
        outline: none;
      }
      button:active {
        border: none;
        text-decoration: none;
        outline: none;
      }
      button:focus {
        border: none;
        text-decoration: none;
        outline: none;
      }
    }
  }
}
.bg_open {
  transform: translateX(-95%);
}
</style>

<template>
  <div class="col-lg-2 col" style="z-index: 1;">
    <div class="bg" :class="{ bg_open: !switchStatus }">
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
                v-if="!login"
              >會員登入</button>
              <button
                class="btn btn-link"
                type="button"
                data-toggle="collapse"
                data-target="#collapseOne"
                v-if="login"
              >會員資料</button>
            </h2>
          </div>

          <div
            id="collapseOne"
            class="collapse show"
            aria-labelledby="headingOne"
            data-parent="#accordionExample"
          >
            <div class="card-body">
              <div class="form-group" v-if="!login">
                <div class="formBox">未登入會員!!</div>
                <div class="formBox">
                  <button class="btn btn-outline-success" @click="ChangeUrl('signin')">我要登入</button>
                  <button class="btn btn-outline-info" @click="ChangeUrl('signup')">我要註冊</button>
                </div>
              </div>
              <div class="form" v-if="login">
                <div class="form-group login">
                  會員名稱UserName：
                  <div class="name">{{ user.name }}</div>
                </div>
                <div class="form-group login">
                  會員階級UserLevel：
                  <div class="name">{{ user.level }}</div>
                </div>
                <div class="form-group login">
                  <button class="btn btn-primary" @click="Logout">登出logout</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    if (localStorage.getItem("token") != null) {
      axios
        .post("/loginOnlyToken", {
          token: localStorage.getItem("token")
        })
        .then(res => {
          this.login = true;
          this.user.name = res.data.name;
          this.user.level = res.data.level;
        });
    } else {
      this.login = false;
    }
  },
  data() {
    return {
      switchStatus: true,
      login: null,
      user: {
        name: "",
        level: ""
      }
    };
  },
  computed: {
    boxSwitchImgUrl() {
      return this.switchStatus
        ? "/images/Lock_open.jpg"
        : "/images/Lock_close.jpg";
    }
  },
  methods: {
    Logout() {
      localStorage.removeItem("token");
      window.location.reload();
    },
    ChangeUrl(val) {
      window.location.href = localStorage.getItem("index") + val;
    }
  }
};
</script>


<style lang="scss" scoped>
* {
  font-family: "標楷體";
  user-select: none;
}
.col {
  .bg {
    border: 1px solid rgb(165, 165, 165);
    margin-top: 80px;
    height: 80vh;
    min-height: 680px;
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
      width: 100%;
      .card-header {
        background-color: rgb(255, 247, 210);
        height: 48px;
        padding: 0;
        button {
          width: 100%;
          font-size: 20px;
          letter-spacing: 8px;
          color: rgb(216, 183, 121);
          font-weight: bold;
          text-decoration: none;
        }
      }
      .card-body {
        .form-group {
          font-size: 18px;
          color: rgb(216, 183, 121);
          .name {
            border: 1px solid rgb(192, 159, 121);
            float: left;
            margin-left: 8px;
            border-radius: 4px;
            color: rgb(175, 139, 71);
          }
          .formBox {
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin-top: 16px;
          }
        }
        .login {
          display: flex;
          align-items: center;
          justify-content: center;
        }
      }
    }
  }
  .bg_open {
    transform: translateX(-95%);
  }
}
</style>

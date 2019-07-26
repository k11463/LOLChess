<template>
  <div class="col-lg-2" style="z-index: 1;">
    <div class="bg" :class="{bg_open: !switchStatus}">
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
              <div v-if="!login" class="form">
                <div class="form-group">
                  <label for="exampleInputEmail1">帳號Account</label>
                  <input
                    type="account"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    placeholder="Enter account"
                    v-model="loginForm.account"
                    @keyup.enter="Login"
                  />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">密碼Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="exampleInputPassword1"
                    placeholder="Password"
                    v-model="loginForm.password"
                    @keyup.enter="Login"
                  />
                </div>
                <div class="form-group form-check">
                  <input
                    type="checkbox"
                    class="form-check-input"
                    id="exampleCheck1"
                    :checked="rememberAccount"
                    @click="rememberAccount = !rememberAccount"
                  />
                  <label class="form-check-label" for="exampleCheck1">記住帳號remenber account</label>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary" @click="Login">登入login</button>
                  <button
                    class="btn btn-secondary"
                    style="float:right;"
                    @click="ChangeUrl('http://127.0.0.1:8000/signup')"
                  >註冊帳號Signup</button>
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
                  <button type="submit" class="btn btn-primary" @click="Logout">登出logout</button>
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
      if (localStorage.getItem("rememberAccount") != null) {
        this.loginForm.account = localStorage.getItem("rememberAccount");
        this.rememberAccount = true;
      }
      this.login = false;
    }
  },
  data() {
    return {
      switchStatus: true,
      rememberAccount: false,
      login: null,
      loginForm: {
        account: "",
        password: ""
      },
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
    Login() {
      axios
        .post("/login", this.loginForm)
        .then(res => {
          if (res.data.error == undefined) {
            if (this.rememberAccount) {
              localStorage.setItem("rememberAccount", res.data.account);
            }
            localStorage.setItem("token", res.data.token);
            window.location.reload();
          } else {
            alert(res.data.error);
          }
        })
        .catch(err => {
          alert(err);
        });
    },
    Logout() {
      localStorage.removeItem("token");
      window.location.reload();
    },
    ChangeUrl(val) {
      window.location.href = val;
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
</style>

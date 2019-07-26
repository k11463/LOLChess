<template>
  <div class="col-lg-8 bg">
    <ErrorAlert :errors="errors" :openAlert="openAlert" @closeAlert="CloseAlert"></ErrorAlert>
    <SuccessAlert
      :title="loginSuccess.title"
      :url="loginSuccess.url"
      :openAlert="loginSuccess.openAlert"
    ></SuccessAlert>
    <div class="container">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <div class="title">會員登入</div>
          <div class="form">
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
                @click="ChangeUrl('signup')"
              >註冊帳號Signup</button>
            </div>
          </div>
        </div>
        <div class="col-lg-2"></div>
      </div>
    </div>
  </div>
</template>

<script>
import ErrorAlert from "../components/ErrorAlert.vue";
import SuccessAlert from "../components/SuccessAlert.vue";
export default {
  mounted() {
    if (localStorage.getItem("rememberAccount") != null) {
      this.loginForm.account = localStorage.getItem("rememberAccount");
      this.rememberAccount = true;
    }
  },
  components: {
    ErrorAlert,
    SuccessAlert
  },
  data() {
    return {
      loginForm: {
        account: "",
        password: ""
      },
      rememberAccount: false,
      errors: [],
      openAlert: false,
      loginSuccess: {
        title: "登入",
        url: "",
        openAlert: false
      }
    };
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
            this.loginSuccess.openAlert = true;
          } else {
            this.openAlert = true;
            this.errors = [];
            this.errors.push(res.data.error);
          }
        })
        .catch(err => {
          this.openAlert = true;
          this.errors = [];
          this.errors.push(err);
        });
    },
    ChangeUrl(val) {
      window.location.href = localStorage.getItem("index") + val;
    },
    CloseAlert(val) {
      this.openAlert = val;
    }
  }
};
</script>

<style lang="scss" scoped>
* {
  font-family: "標楷體";
}
.bg {
  margin-top: 180px;
  .title {
    height: 60px;
    font-size: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .form-group {
    margin-top: 44px;
  }
}
</style>

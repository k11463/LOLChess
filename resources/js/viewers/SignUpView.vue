<template>
  <div class="col-lg-8 bg">
    <ErrorAlert :errors="errors" :openAlert="openAlert" @closeAlert="CloseAlert"></ErrorAlert>
    <SuccessAlert
      :title="signUpSuccess.title"
      :url="signUpSuccess.url"
      :openAlert="signUpSuccess.openAlert"
    ></SuccessAlert>
    <div class="container" style="padding: 20px;">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <div class="title">會員註冊</div>
          <div class="form">
            <div class="form-group">
              <label for="exampleInputEmail1">會員名稱UserName</label>
              <input
                type="name"
                class="form-control"
                id="exampleInputEmail1"
                v-model="form.name"
                placeholder="name"
                @keyup.enter="SignUp"
              />
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">會員帳號Account</label>
              <input
                type="account"
                class="form-control"
                id="exampleInputEmail1"
                v-model="form.account"
                placeholder="account"
                @keyup.enter="SignUp"
              />
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">會員密碼Password</label>
              <input
                type="password"
                class="form-control"
                id="exampleInputPassword1"
                placeholder="password"
                v-model="form.password"
                @keyup.enter="SignUp"
              />
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">密碼確認ConfirmPassword</label>
              <input
                type="password"
                class="form-control"
                id="exampleInputPassword1"
                placeholder="confirm_password"
                v-model="form.confirmPassword"
                @keyup.enter="SignUp"
              />
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">會員信箱Email</label>
              <input
                type="email"
                class="form-control"
                id="exampleInputPassword1"
                v-model="form.email"
                placeholder="email"
                @keyup.enter="SignUp"
              />
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block mt-4" @click="SignUp">註冊</button>
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
  components: {
    ErrorAlert,
    SuccessAlert
  },
  data() {
    return {
      form: {
        name: "",
        account: "",
        password: "",
        confirmPassword: "",
        email: ""
      },
      errors: [],
      openAlert: false,
      signUpSuccess: {
        title: "註冊",
        url: "signin",
        openAlert: false
      }
    };
  },
  methods: {
    SignUp() {
      if (this.form.password == this.form.confirmPassword) {
        axios
          .post("/signup", this.form)
          .then(res => {
            if (res.data.error == undefined) {
              this.signUpSuccess.openAlert = true;
            } else {
              this.errors = [];
              this.errors.push(res.data.error);
              this.openAlert = true;
            }
          })
          .catch(err => {
            // err.response.data.errors;
            if (err.response.status == 422) {
              this.openAlert = true;
              this.errors = [];
              //   console.log(this.errors);
              Object.keys(err.response.data.errors).forEach(key => {
                this.errors.push(err.response.data.errors[key][0]);
                //   console.log(err.response.data.errors[key][0]);
              });
            }
          });
      } else {
        this.openAlert = true;
        this.errors.push("密碼不一樣,請重新輸入!");
      }
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
  height: 50vh;
  margin-top: 100px;
  .title {
    height: 56px;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    font-size: 32px;
  }
  .form-group {
    margin-top: 20px;
  }
  .form-group:last-child {
    margin-top: 40px;
  }
}
</style>


<template>
  <div class="col-lg-8">
    <ModalAlert :errors="errors" :openAlert="openAlert" @closeAlert="CloseAlert"></ModalAlert>
    <div class="container" style="padding: 20px;">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <div class="bg mt-5">
            <div class="form">
              <div class="form-group">
                <label for="exampleInputEmail1">會員名稱</label>
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
                <label for="exampleInputEmail1">會員帳號</label>
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
                <label for="exampleInputPassword1">會員密碼</label>
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
                <label for="exampleInputPassword1">密碼確認</label>
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
                <label for="exampleInputPassword1">會員信箱</label>
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
                <button class="btn btn-primary" @click="SignUp">註冊</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-2"></div>
      </div>
    </div>
  </div>
</template>

<script>
import ModalAlert from "../components/ModalAlert.vue";
export default {
  components: {
    ModalAlert
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
      openAlert: false
    };
  },
  methods: {
    SignUp() {
      if (this.form.password == this.form.confirmPassword) {
        axios
          .post("/signup", this.form)
          .then(res => {
            if (res.data.error == undefined) {
              alert("註冊成功");
              window.location.reload();
              console.log("d1s2a6d4");
            } else {
              alert(res.data.error);
            }
          })
          .catch(err => {
            // err.response.data.errors;
            if (err.response.status == 422) {
              this.openAlert = true;
              this.errors = [];
              console.log(this.errors);
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
.bg {
  height: 50vh;
  .modal-dialog {
    z-index: 0;
    .modal-content {
      z-index: 0;
    }
  }
}
</style>


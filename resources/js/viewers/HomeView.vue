<template>
  <div class="container">
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
    <div class="errors">
      <div
        class="alert alert-danger alert-dismissible fade show"
        role="alert"
        v-for="(error, id) in errors"
        :key="id"
      >
        {{ error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: "",
        account: "",
        password: "",
        confirmPassword: "",
        email: ""
      },
      errors: []
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
            this.errors.length = 0;
            Object.keys(err.response.data.errors).forEach(key => {
              this.errors.push(err.response.data.errors[key][0]);
              //   console.log(err.response.data.errors[key][0]);
            });
          });
      } else {
        alert("密碼不一樣,請重新輸入!");
      }
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


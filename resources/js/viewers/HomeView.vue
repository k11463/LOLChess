<template>
  <div class="container">
    <div class="col lg-8 bg">
      <form>
        <div class="form-group">
          <label for="exampleInputEmail1">會員ID</label>
          <input
            type="name"
            class="form-control"
            id="exampleInputEmail1"
            v-model="form.name"
            placeholder="name"
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
          />
        </div>
        <div class="form-group">
          <button class="btn btn-primary" @click="SignUp">註冊</button>
        </div>
      </form>
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
      }
    };
  },
  methods: {
    SignUp() {
      if (this.form.password == this.form.confirmPassword) {
        axios
          .post("/signup", this.form)
          .then(res => {
            alert("success");
            console.log(res.data);
          })
          .catch(err => {
            alert(err);
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
  float: left;
  height: 97vh;
}
</style>


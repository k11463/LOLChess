<template>
  <div class="col-lg-8 bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 ad"></div>
      </div>
      <div class="row">
        <div class="col-lg-2">
          <div class="bg" :class="{bg_open: !switchStatus}">
            <div class="accordion" id="bloodAccordion">
              <div class="card">
                <div class="card-header" id="bloodHead">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link"
                      type="button"
                      data-toggle="collapse"
                      data-target="#bloodTarget"
                    >種族</button>
                  </h2>
                </div>

                <div
                  id="bloodTarget"
                  class="collapse show"
                  aria-labelledby="bloodHead"
                  data-parent="#bloodAccordion"
                >
                  <div class="card-body">Blood</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-10"></div>
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
  height: 80vh;
  .ad {
    border: 1px solid #000;
    height: 100px;
  }
}
</style>


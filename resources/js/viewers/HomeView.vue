<template>
  <div class="col-lg-8 bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 ad"></div>
      </div>
      <div class="row">
        <div class="col-lg-2 selected">
          <div class="accordion" id="accordion">
            <div class="card">
              <div class="card-header" id="bloodHead">
                <h2 class="mb-0">
                  <button
                    class="btn btn-link"
                    type="button"
                    data-toggle="collapse"
                    aria-expanded="true"
                    data-target="#blood"
                    aria-controls="blood"
                  >種族</button>
                </h2>
              </div>

              <div
                id="blood"
                class="collapse show"
                aria-labelledby="bloodHead"
                data-parent="#accordion"
              >
                <div class="card-body">
                  <div
                    class="tag"
                    v-for="(blood, id) in bloods"
                    :key="id"
                    @click="ClickTag('blood', blood.name), blood.active = !blood.active"
                    :class="{ active: blood.active }"
                  >
                    <img width="32" :src="blood.img" alt />
                    {{ blood.name }}
                  </div>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header" id="jobHead">
                <h2 class="mb-0">
                  <button
                    class="btn btn-link collapsed"
                    type="button"
                    data-toggle="collapse"
                    data-target="#job"
                    aria-controls="job"
                    aria-expanded="false"
                  >職業</button>
                </h2>
              </div>

              <div id="job" class="collapse" aria-labelledby="jobHead" data-parent="#accordion">
                <div class="card-body">
                  <div
                    class="tag"
                    v-for="(job, id) in jobs"
                    :key="id"
                    @click="ClickTag('job', job.name), job.active = !job.active"
                    :class="{ active: job.active }"
                  >
                    <img width="32" :src="job.img" alt />
                    {{ job.name }}
                  </div>
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
  mounted() {
    localStorage.setItem("index", window.location.href);
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
      bloods: [
        {
          name: "冰川使者",
          img: "/images/blood/Glacial_TFT_icon.png",
          active: false
        },
        {
          name: "虛空使者",
          img: "/images/blood/Void_TFT_icon.png",
          active: false
        },
        {
          name: "約德爾人",
          img: "/images/blood/Yordle_TFT_icon.png",
          active: false
        },
        {
          name: "機器人",
          img: "/images/blood/Robot_TFT_icon.png",
          active: false
        },
        {
          name: "惡魔",
          img: "/images/blood/Demon_TFT_icon.png",
          active: false
        },
        {
          name: "龍族",
          img: "/images/blood/Dragon_TFT_icon.png",
          active: false
        },
        {
          name: "帝王",
          img: "/images/blood/Imperial_TFT_icon.png",
          active: false
        },
        {
          name: "忍者",
          img: "/images/blood/Ninja_TFT_icon.png",
          active: false
        },
        {
          name: "貴族",
          img: "/images/blood/Noble_TFT_icon.png",
          active: false
        },
        {
          name: "鬼魅",
          img: "/images/blood/Phantom_TFT_icon.png",
          active: false
        },
        {
          name: "獸人",
          img: "/images/blood/Wild_TFT_icon.png",
          active: false
        },
        {
          name: "浪人",
          img: "/images/blood/Exile_TFT_icon.png",
          active: false
        }
      ],
      seletedBloods: [],
      jobs: [
        {
          name: "武鬥家",
          img: "/images/job/Brawler_TFT_icon.png",
          active: false
        },
        {
          name: "元素使",
          img: "/images/job/Elementalist_TFT_icon.png",
          active: false
        },
        {
          name: "守護者",
          img: "/images/job/Guardian_TFT_icon.png",
          active: false
        },
        {
          name: "神槍手",
          img: "/images/job/Gunslinger_TFT_icon.png",
          active: false
        },
        {
          name: "變形師",
          img: "/images/job/Shapeshifter_TFT_icon.png",
          active: false
        },
        {
          name: "刺客",
          img: "/images/job/Assassin_TFT_icon.png",
          active: false
        },
        {
          name: "劍士",
          img: "/images/job/Blademaster_TFT_icon.png",
          active: false
        },
        {
          name: "騎士",
          img: "/images/job/Knight_TFT_icon.png",
          active: false
        },
        {
          name: "遊俠",
          img: "/images/job/Ranger_TFT_icon.png",
          active: false
        },
        {
          name: "巫師",
          img: "/images/job/Sorcerer_TFT_icon.png",
          active: false
        }
      ],
      seletedJobs: []
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
    },
    ClickTag(tag, name) {
      var index = -1;
      var arrlen = 0;

      if (tag == "blood") {
        arrlen = this.seletedBloods.length;
      } else if (tag == "job") {
        arrlen = this.seletedJobs.length;
      }

      for (var i = 0; i < arrlen; i++) {
        if (tag == "blood") {
          if (this.seletedBloods[i] == name) {
            index = i;
          }
        } else if (tag == "job") {
          if (this.seletedJobs[i] == name) {
            index = i;
          }
        }
      }

      if (index == -1) {
        if (tag == "blood") {
          this.seletedBloods.push(name);
        } else if (tag == "job") {
          this.seletedJobs.push(name);
        }
      } else {
        if (tag == "blood") {
          this.seletedBloods.splice(index, i);
        } else if (tag == "job") {
          this.seletedJobs.splice(index, i);
        }
      }
      console.log(this.seletedBloods);
      console.log(this.seletedJobs);
    }
  }
};
</script>

<style lang="scss" scoped>
* {
  user-select: none;
}
.bg {
  height: 80vh;
  margin-top: 80px;
  .ad {
    border: 1px solid #000;
    height: 100px;
  }
  .selected {
    height: 660px;
    .card {
      width: 120%;
      margin-left: -10%;
      .card-header {
        padding: 0;
        button {
          width: 100%;
          height: 52px;
          background-color: rgb(255, 247, 210);
          color: rgb(216, 183, 121);
          text-decoration: none;
          font-size: 18px;
          letter-spacing: 4px;
        }
        button:hover {
          color: rgb(216, 183, 121);
        }
      }
      .card-body {
        .tag {
          width: 80px;
          background-color: rgb(255, 227, 191);
          letter-spacing: 2%;
          font-size: 16px;
          color: rgb(133, 98, 58);
          font-weight: bold;
          border-radius: 12px;
          margin-top: 8px;
          display: flex;
          align-items: center;
          justify-content: center;
          margin-left: 24%;
          cursor: pointer;
          img {
            margin-right: 4px;
          }
        }
        .tag:first-child {
          margin-top: -4px;
        }
        .tag.active {
          border: 2px solid rgb(155, 128, 93);
        }
      }
    }
  }
}
</style>


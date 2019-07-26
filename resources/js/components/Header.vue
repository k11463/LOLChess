<template>
  <div class="row">
    <div class="col-lg-6 col" v-for="(item, id) in items" :key="id" @click="ChangeUrl(item.url)">
      <img width="128" v-if="item.isUrl" src="/images/selected.png" alt />
      <img width="104" v-if="!item.isUrl" src="/images/noSelect.png" alt />
      <span>{{ item.title }}</span>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.nowLocation = window.location.href;
    for (var i = 0; i < this.items.length; i++) {
      if (
        this.nowLocation ==
        localStorage.getItem("index") + this.items[i].url
      ) {
        this.items[i].isUrl = true;
      }
    }
  },
  data() {
    return {
      items: [
        {
          title: "搜尋英雄",
          url: "",
          isUrl: false
        },
        {
          title: "裝備",
          url: "equip",
          isUrl: false
        }
      ],
      nowLocation: ""
    };
  },
  methods: {
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
.row {
  background-color: rgb(208, 232, 255);
  position: absolute;
  width: 100vw;
  z-index: 1;
  .col {
    border-top: 1px solid rgb(100, 127, 187);
    border-bottom: 1px solid rgb(100, 127, 187);
    border-right: 1px solid rgb(100, 127, 187);
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: 0.4s;
    span {
      font-size: 24px;
      letter-spacing: 4px;
      font-weight: bold;
    }
  }
  @keyframes imgAction {
    0% {
      margin-top: 0;
      margin-left: 0;
    }
    25% {
      margin-top: 4px;
      margin-left: 4px;
    }
    50% {
      margin-top: 0;
      margin-left: 0;
    }
    75% {
      margin-top: -4px;
      margin-left: -4px;
    }
    100% {
      margin-top: 0;
      margin-left: 0;
    }
  }
  .col:hover {
    color: rgb(228, 80, 60);
    span {
      letter-spacing: 3px;
    }
    img {
      animation-name: imgAction;
      animation-duration: 0.1s;
      animation-iteration-count: infinite;
    }
  }
}
</style>

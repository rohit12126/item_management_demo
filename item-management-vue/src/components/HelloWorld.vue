<template>
  <div class="main-container">
    <h1 class="main-title">Item Management Page</h1>

    <div class="box-wrap">
      <div class="left-content-wrap">
        <div class="input-div">
          <input
            type="text"
            name=""
            id=""
            v-model="item_name"
            class="custom-input"
          />
          <button @click="add()" class="theme-btn">Add</button>
          <span class="error-text" v-show="itemExistMsg !== ''">{{
            itemExistMsg
          }}</span>
        </div>
        <div class="common-box">
          <ul class="list-group">
            <li
              v-for="item in left_items"
              :key="item"
              @click="activate(item)"
              :class="{ active: active_el == item }"
            >
              {{ item }}
            </li>
          </ul>
        </div>
      </div>

      <div class="mid-content-wrap">
        <div class="btn-div">
          <button @click="addToRight()" class="theme-btn">></button>

          <button @click="addToLeft()" class="theme-btn">&lt;</button>
        </div>
      </div>

      <div class="right-content-wrap">
        <div class="sub-title">Selected Item:</div>
        
        <div class="common-box">
          <ul class="list-group">
            <li
              v-for="item in right_items"
              :key="item"
              @click="activate(item)"
              :class="{ active: active_el == item }"
            >
              {{ item }}
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div v-show="noItemSelectedForMoveMsg !== ''" class="error-div">
          {{ noItemSelectedForMoveMsg }}
    </div>
  </div>
</template>

<script>
var date = new Date();
var uniqueToken = [
  date.getYear(),
  date.getMonth(),
  date.getDate(),
  date.getHours(),
  date.getMinutes(),
  date.getSeconds(),
  date.getMilliseconds(),
];
if (localStorage.getItem("item_management_token") === null) {
  localStorage.setItem("item_management_token", uniqueToken.join(""));
}
const APIURL = "http://localhost/item_management_demo/item_management_api/";
import axios from "axios";
import DefaultLayout from "../layouts/DefaultLayout";

export default {
  name: "HelloWorld",
  created() {
    this.getItemList(), this.$emit("update:layout", DefaultLayout);
  },
  data() {
    return {
      item_name: "",
      left_items: [],
      right_items: [],
      item_list: [],
      itemExistMsg: "",
      active_el: "",
      noItemSelectedForMoveMsg: "",
    };
  },
  methods: {
    add() {
      if (this.item_name == "") {
        this.itemExistMsg = "Please enter item name!";
      } else if (this.item_list.includes(this.item_name) === false) {
        this.item_list.push(this.item_name);
        this.left_items.push(this.item_name);
        this.saveItem(this.item_name, "left");
        this.item_name = "";
      } else {
        this.itemExistMsg = this.item_name + " item already exist!";
      }
    },
    addToRight() {
      // console.log(  )
      if (
        this.isElementSelected() === true &&
        this.right_items.includes(this.active_el) === false
      ) {
        this.saveItem(this.active_el, "right");
        this.right_items.push(this.active_el);
        this.left_items.splice(this.left_items.indexOf(this.active_el), 1);
        this.activate("");
      } else {
        this.noItemSelectedForMoveMsg = "Please select an item from left list";
      }
    },
    addToLeft() {
      if (
        this.isElementSelected() === true &&
        this.left_items.includes(this.active_el) === false
      ) {
        this.saveItem(this.active_el, "left");
        this.left_items.push(this.active_el);
        this.right_items.splice(this.right_items.indexOf(this.active_el), 1);
        this.activate("");
      } else {
        this.noItemSelectedForMoveMsg = "Please select an item from right list";
      }
    },
    activate: function (el) {
      this.active_el = el;
    },
    isElementSelected() {
      if (this.active_el == "") {
        this.noItemSelectedForMoveMsg = "Please select an item for move";
        return false;
      } else {
        this.noItemSelectedForMoveMsg = "";
        return true;
      }
    },
    isSelectedItemInRight() {
      if (this.right_items.includes(this.active_el) === true) {
        return true;
      } else {
        return false;
      }
    },
    saveItem: function (name, position) {
      const data = {
        name: name,
        position: position,
        token: localStorage.getItem("item_management_token"),
      };
      const response = axios.post(APIURL + "api/item/add-update", data);
      response
        .then((response) => {
          console.log(response.data);
        })
        .catch((e) => {
          var error = e.response.data;
          console.log(error);
        });
    },
    getItemList() {
      const data = { token: localStorage.getItem("item_management_token") };
      const response = axios.get(APIURL + "api/item/get/list", {
        params: data,
      });
      response
        .then((response) => {
          var left = response.data.data.left;
          left.forEach((e) => {
            this.item_list.push(e.name);
            this.left_items.push(e.name);
          });

          var right = response.data.data.right;
          right.forEach((e) => {
            this.item_list.push(e.name);
            this.right_items.push(e.name);
          });
        })
        .catch((e) => {
          var error = e.response.data;
          console.log(error);
        });
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.box-wrap {
  display: flex;
  width: 100%;
  flex-wrap: wrap;
}
.left-content-wrap,
.right-content-wrap {
  flex: 0 0 40%;
  max-width: 40%;
}
.mid-content-wrap {
  flex: 0 0 20%;
  max-width: 20%;
  align-self: center;
}
.input-div {
  display: flex;
  margin-bottom: 25px;
  position: relative;
}
.custom-input {
  display: block;
  width: 100%;
  height: 35px;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  margin-right: 10px;
}

.theme-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-weight: 400;
  color: #212529;
  text-align: center;
  vertical-align: middle;
  user-select: none;
  padding: 6px 12px;
  height: 35px;
  font-size: 15px;
  line-height: 1.5;
  border-radius: 0.25rem;
  transition: all 0.3s ease;
  background-color: #c6c8cb;
      border: 1px solid #b0b1b2;
  box-shadow: none;
}
.theme-btn:hover {
  color: #000;
  background-color: #bcbcbc;
  border-color: #bcbcbc;
}

.btn-div {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-flow: column;
  flex-wrap: wrap;
  margin: 0px 20px;
}

.btn-div .theme-btn {
  width: 50px;
  margin-bottom: 8px;
}
.common-box {
  border: 1px solid #ced4da;
  min-height: 180px;
  margin-bottom: 16px;
}
.list-group {
  display: flex;
  flex-direction: column;
  padding-left: 0;
  margin: 0;
  list-style-type: none;
  padding: 0;
}
.list-group li {
  position: relative;
  display: block;
  padding: 12px 20px;
  cursor: pointer;
  font-weight: 600;
}
.list-group li:hover {
  background-color: #f2f2f2;
}
.list-group li.active {
  background-color: #6ac1f4;
    color: #1b6089;
}
.sub-title {
  font-size: 32px;
  margin-bottom: 12px;
  color: #262626;
  font-weight: 700;
}

.error-div {
  color: red;
  font-size: 14px;
  text-align: center;
  margin-top:10px;
}
.error-text{
    position: absolute;
    bottom: -17px;
    left: 0px;
    color: red;
    font-size: 13px;
}
</style>
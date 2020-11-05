<template>
  <div class="Home">
    <header class="main-header">
      
        <div class="main-logo">Logo</div>
        <nav class="main-navbar">
          <router-link to="/">Home</router-link> |
          <router-link to="/contact">Contact</router-link>
        </nav>
      
    </header>

    <slot></slot>
  </div>
</template>

<style >
body {
  margin: 0;
  padding: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen",
    "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue",
    sans-serif;
  font-size: 14px;
}
*, ::after, ::before {
    box-sizing: border-box;
}
.main-header{
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 20px;
}
.main-logo{
      font-size: 28px;
    color: #000;
    font-weight: 600;
}
.main-navbar a{
  font-size: 15px;
    color: #000;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 10px 20px;
    text-decoration: none;
}
.main-navbar a.router-link-active{
  font-weight:500;
}
.main-navbar a:hover{
  color:#343a40;
  
}
.main-container {
  width: 100%;
  padding: 40px 40px;
  box-sizing: border-box;
  max-width: 1000px;
  margin: 0 auto;
}
.main-title {
  font-size: 40px;
  margin-bottom: 20px;
  margin-top: 0px;
  color: #262626;
  font-weight: 700;
}
.common-text{
  font-size:15px;
  line-height:1.5;
  color:#333;
  margin-bottom:20px;

}
</style>

<script>
// import DefaultLayout from '../layouts/DefaultLayout.vue';

// export default {
//   name: 'Home',
//   created() {
//     this.$emit('update:layout', DefaultLayout);
//   },
// };
</script>
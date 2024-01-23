<template>
<header>
  <nav class="menu">
    <a> Connexion </a>
    <a> Inscription </a>
  </nav>
</header>
</template>

<style scoped>
header{
  background-image: url("@/assets/images/background/header-background.svg");
  height: 100px;
  flex-shrink: 0;
}

nav{
  padding: 30px 30px 0 0;
  display: flex;
  height: 100px;
  justify-content: flex-end;
  align-items: flex-start;
  gap: 41px;
  flex-shrink: 0;
}

a{
  color: #FFF;
  font-family: NotoSans,serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}

</style>
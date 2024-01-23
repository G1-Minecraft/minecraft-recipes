<template>
  <main>
    <form action="" method="get" class="form-example">
      <div class="form-example">
        <label for="name">Nom d'utilisateur</label>
        <input type="text" name="name" id="name" required />
      </div>
      <div class="form-example">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required />
      </div>
      <div class="form-example">
        <input type="submit" value="Subscribe!" />
      </div>
    </form>
  </main>
</template>

<style scoped>
main{
  background-image: url("@/assets/images/background/form-connexion-background.svg");
  width: 75%;
  flex-shrink: 0;
}
</style>
<script setup lang="ts">
</script>
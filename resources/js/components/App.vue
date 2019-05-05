<template>
    <div>
        <h1>Reward Getaway Test</h1>

        <p>
            <router-link :to="{ name: 'list' }">List of Employees</router-link>
        </p>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {}
</script>
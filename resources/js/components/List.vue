<template>
    <div class="list">
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <div v-if="error" class="error">
            {{ error }}
        </div>

        <div class="container">
            <div class="row" v-if="list">
            <br><br>
                <div v-for="{ name, avatar, bio, company } in list" class="span3 well column">
                    <div class="row text-center">
                        <img v-bind:src="avatar" name="aboutme" width="100" height="100" class="img-circle">
                    </div>
                    <h4>{{ name }}</h4>
                    <p class="text-left"><strong>Company: </strong><br>{{ company }}<br>
                    <hr>
                    <p class="text-left ellipsis"><strong>Bio: </strong>{{ bio }}</p>
                    <br>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                loading: false,
                list: null,
                error: null,
            };
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.error = this.list = null;
                this.loading = true;
                axios
                    .get('/api/list')
                    .then(response => {
                        this.loading = false;
                        this.list = response.data.data;
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.message || error.message;
                });
            }
        }
    }
</script>
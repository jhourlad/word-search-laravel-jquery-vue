<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 p-2 clickable" v-if="searches.length > 0" v-for="search in searches" v-bind:key="search.id">
                <a :href="'/?query=' + search.word" class="alert alert-primary d-block text-center text-lowercase" :title="'(' + search.part_of_speech + ') ' + search.definition">
                    {{ search.word }} ({{ search.hits }})
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                searches: [],
            }
        },

        created() {
            this.fetchSearches();
        },

        methods: {
            /**
             * Fetch previous searches
             */
            fetchSearches() {
                axios
                    .get('/api/search')
                    .then(data => {
                            console.log('data.data', data.data, data.data.length);
                            this.searches = data.data;
                        }
                    )
            }
        }
    }
</script>

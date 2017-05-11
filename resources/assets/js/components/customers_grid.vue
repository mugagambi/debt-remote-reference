<template>
    <div id="demo">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <h4 class="title">Search Customer by national ID/phone number</h4>
                <form id="search" v-on:submit.prevent="">
                    <input class="form-control" name="query" v-model="searchQuery">
                </form>
            </div>
        </div>
            <grid
                    :data="gridData"
                    :columns="gridColumns"
                    :filter-key="searchQuery">
            </grid>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                searchQuery: '',
                gridColumns: ['first_name', 'last_name', 'email', 'phone', 'address', 'national_id'],
                gridData: []
            }
        },
        created () {
            axios.get('/customers/list')
                .then((response) => {
                this.gridData = response.data;
                })
        }
    }
</script>
<style>
</style>
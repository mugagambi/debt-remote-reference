<template>
    <div id="debtors">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <h4 class="title">Filter debtors by any field in the table</h4>
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
                gridColumns: ['first_name', 'last_name', 'email', 'phone', 'address', 'national_id', 'amount', 'date_credited'],
                gridData: []
            }
        },
        created () {
            axios.get('/debtors/list')
                .then((response) => {
                this.gridData = response.data;
                })
        }
    }
</script>
<style scoped>
    #debtors {
        font-family: Helvetica Neue, Arial, sans-serif;
        font-size: 14px;
        color: #444;
        margin-bottom: 50px;
    }
    #search {
        margin-bottom: 20px;
    }

</style>
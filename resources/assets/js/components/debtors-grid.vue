<template>
    <div id="debtors">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <h3 class="title">Filter debtors by any field in the table</h3>
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
        <paginator :previous_url="previous_url"
                   :next_url="next_url"
                    @next="onNextClicked"
                    @previous="onPreviousClicked"
        ></paginator>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                searchQuery: '',
                gridColumns: ['first_name', 'last_name', 'email', 'phone', 'address', 'national_id', 'amount', 'date'],
                gridData: [],
                previous_url: null,
                next_url: null
            }
        },
        created () {
            axios.get('/debtors/list/')
                .then((response) => {
                this.gridData = response.data.data;
                this.previous_url = response.data.prev_page_url;
                this.next_url = response.data.next_page_url;
                })
        },
        methods: {
            onNextClicked()
            {
                axios.get(this.next_url)
                    .then((response) => {
                        this.gridData = response.data.data;
                        this.previous_url = response.data.prev_page_url;
                        this.next_url = response.data.next_page_url;
                    })
            },
            onPreviousClicked()
            {
                axios.get(this.previous_url)
                    .then((response) => {
                        this.gridData = response.data.data;
                        this.previous_url = response.data.prev_page_url;
                        this.next_url = response.data.next_page_url;
                    })
            }
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
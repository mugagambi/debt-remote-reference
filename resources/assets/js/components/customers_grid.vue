<template>
    <div id="demo">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <form id="search" v-on:submit.prevent="">
                    Search <input class="form-control" name="query" v-model="searchQuery">
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
    #demo {
        font-family: Helvetica Neue, Arial, sans-serif;
        font-size: 14px;
        color: #444!important;
    }
    table {
        border: 2px solid #42b983;
        border-radius: 3px;
        background-color: #fff!important;
    }
    th {
        background-color: #42b983!important;
        color: rgba(255,255,255,0.66)!important;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    td {
        background-color: #f9f9f9;
    }

    th, td {
        min-width: 120px;
        padding: 10px 20px;
    }

    th.active {
        color: #fff!important;
    }
    th.active .arrow {
        opacity: 1!important;
    }

    .arrow {
        display: inline-block;
        vertical-align: middle;
        width: 0;
        height: 0;
        margin-left: 5px;
        opacity: 0.66;
    }

    .arrow.asc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-bottom: 4px solid #fff;
    }

    .arrow.dsc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 4px solid #fff;
    }
    #search {
        margin-bottom: 20px;
    }
</style>
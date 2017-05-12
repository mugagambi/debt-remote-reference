<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <nav aria-label="...">
                <ul class="pager">
                    <span v-if="previous_url">
                    <li><a href="#" @click.prevent="previousClicked">Previous</a></li>
                    </span>
                    <span v-else>
                       <li class="disabled"><a href="#" @click.prevent="">Previous</a></li>
                    </span>
                    <span v-if="next_url">
                    <li><a href="#" @click.prevent="nextClicked">Next</a></li>
                    </span>
                    <span v-else>
                        <li class="disabled"><a href="#" @click.prevent="">Next</a></li>
                    </span>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        next_url: {
            required: true
        },
        previous_url: {
            required: true
        }
    },
    methods: {
        nextClicked ()
        {
            this.$emit('next');

        },
        previousClicked ()
        {
            this.$emit('previous');
        }
    }
}
</script>
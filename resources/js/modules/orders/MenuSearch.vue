<template>
    <div class="wrapper mb-3">
        <input type="text" placeholder="Search here..." v-model="search" class="form-control">
    </div>
</template>
<script>
    export default {
        props: ['items'],
        data() {
            return {
                search: ''
            }
        },
        computed: {
            filterSearch() {
                return this.items.filter(item => {
                    return item.name.toLowerCase().includes(this.search.toLowerCase());
                })
            }
        },
        watch: {
            search(value) {
                if(value != '') {
                    window.eventBus.$emit('filteredList', this.filterSearch);
                } else {
                    window.eventBus.$emit('clearfilteredList');
                }
            }
        }
    }
</script>
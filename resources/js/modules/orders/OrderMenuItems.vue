<template>
    <div class="wrapper">
        <menu-search :items="items"></menu-search>
        <menu-items :items="items"></menu-items>
    </div>
</template>

<script>
    import MenuSearch from './MenuSearch.vue';
    import MenuItems from './MenuItems.vue';
    export default {
        props: ['items'],
        components:{
            MenuItems,
            MenuSearch
        } 
        // methods: {
        //     handleAddButton(item) {
        //         this.$emit('menu-item-added', item);
        //     }
        // }
    }
</script>
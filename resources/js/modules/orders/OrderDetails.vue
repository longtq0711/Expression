<template>
    <ul class="list-group">
        <li class="list-group-item" v-for="(item, key) in orderDetails" :key="key">
            {{ item.name }} <span class="float-right">{{ item.price }}</span>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['orderDetails']
    }
</script>
<template>
    <div>
        <div v-if="orderDetails && orderDetails.length > 0">
            <ul class="list-group">
                <li class="list-group-item" v-for="(item, key) in orderDetails" :key="key">
                    {{ item.name }} <span class="float-right">{{ item.price }}</span>
                </li>
            </ul>
        </div>
        <div v-else>
        <p>No items ordered yet</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['orderDetails']
    }
</script>
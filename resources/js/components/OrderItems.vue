<template>
    <tbody>
        <tr v-for="(order, key) in orders" :key="key">
            <td>{{order.id}}</td>
            <td>{{order.amount}}</td>
            <td>{{(order.isComplete) ? 'Completed' : 'Incomplete'}}</td>
            <td>
                Name: {{order.order_details.customer_name}}
                <br>
                Phone: {{order.order_details.customer_phone}}
                <br>
                Address: {{order.order_details.customer_address}}
            </td>
            <td>
                <button class="btn btn-primary mr-3" @click="clickEdit(order)">✐</button>
                <button class="btn btn-success mr-3" @click="clickComplete(order)">✔</button>
                <button class="btn btn-warning" @click="clickEdit(order)">✘</button>
            </td>
        </tr>
    </tbody>
</template>
<script>
    export default {
        props: ['orders'],
        methods: {
            clickComplete(order) {
                this.$emit('completeOrder', order);
            }, 
            clickDelete(order) {
                this.$emit('removeOrder', order);
            },
            clickEdit(order) {
                return window.location.href = "/restaurants/" + 1 + "/orders/" + order.id +"/edit";
            }
        }
    }
</script>
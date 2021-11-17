<template>
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>Order Id</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Customer details</th>
                <th>Action</th>
            </tr>
        </thead>
        <order-items 
            :orders="orderData"
            @completeOrder="handleCompleteOrder"
            @removeOrder="handleRemoveOrder"
        ></order-items>
    </table> 
</template>

<script>
    import OrderItems from '../../components/OrderItems.vue'
    export default {
        components: {
            OrderItems
        },
        props: ['orders'],
        data() {
            return {
                orderData: []
            }
        },
        created() {
            this.orderData = this.orders.data;
        },
        methods: {
            handleCompleteOrder(order) {
                let orderId = {id: order.id};
                let scop = this;
                Swal.fire({
                    title: 'Do you want to complete order?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.value) {
                        axios.post('/order/complete', orderId).then(function(response) {
                            if(response.status == 200) {
                                Swal.fire({
                                icon: 'success',
                                title: '',
                                text: response.data.message,
                                }).then((result) => {
                                    scop.orderData.forEach(function(item) {
                                        if(item.id === order.id) {
                                            item.isComplete = 1;
                                        }
                                    }); 
                                })
                            }
                        }).catch(function(error) {
                            console.log(error);
                        })
                    }
                    
                })
                
            },
            handleRemoveOrder(order) {
                let orderId = {id: order.id};
                let scop = this;
                Swal.fire({
                    title: 'Do you sure want to delete order?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.value) {
                        axios.post('/order/remove', orderId).then(function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: '',
                                text: response.data.message,
                            }).then((result) => {
                                scop.orderData = scop.orderData.filter(localOrder => {
                                    return localOrder.id !== order.id
                                })
                            })
                        }).catch(function(error) {
                            console.log(error);
                        })
                    }
                })
            }
        }
    }
</script>
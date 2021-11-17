<template>
    <div class="wrapper">
        <form action="#">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" v-model="customer.name">
            </div>
            
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" class="form-control" v-model="customer.phone">
            </div>

            <div class="form-group">
                <label for="">Address</label>
                <input type="text" class="form-control" v-model="customer.address">
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            customer: {
                name: '',
                phone: '',
                address: ''
            }
        }
    },
    watch: {
        customer: {
            handler(value) {
                let customer = {
                    name: value.name,
                    phone: value.phone,
                    address: value.address
                }
                this.$emit('customerDetailChanged', customer)
            }, deep: true
        }
    }
}
</script>
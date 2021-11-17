<template>
    <div class="wrapper">
        <form action="#">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" v-model="customer.name">
                <div class="validation-message" v-if="errors.name">{{ errors.name }}</div>
            </div>
            
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" class="form-control" v-model="customer.phone">
                 <div class="validation-message" v-if="errors.phone">{{ errors.phone }}</div>
            </div>

            <div class="form-group">
                <label for="">Address</label>
                <input type="text" class="form-control" v-model="customer.address">
                <div class="validation-message" v-if="errors.address">{{ errors.address }}</div>
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
            },
        }
    },
    props: {
        customerDetails: {
            type: [Array, Object], 
        },
        errors: {
            type: Array,
            required: false
        }
    },
    created() {
        if (this.customerDetails) {
            this.customer.name = this.customerDetails.customer_name;
            this.customer.phone = this.customerDetails.customer_phone;
            this.customer.address = this.customerDetails.customer_address;
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
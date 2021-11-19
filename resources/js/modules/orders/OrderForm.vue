<template>
    <div class="wrapper">
        <form action="#">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" v-model="customer.name">
                <div class="validation-message" v-if="errors.name">{{ errors.name }}</div>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" v-model="customer.phone">
                 <div class="validation-message" v-if="errors.phone">{{ errors.phone }}</div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" v-model="customer.address">
                <div class="validation-message" v-if="errors.address">{{ errors.address }}</div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" v-model="customer.email">
                <div class="validation-message" v-if="errors.email">{{ errors.email }}</div>
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
                address: '',
                email: ''
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
            this.customer.email = this.customerDetails.customer_email;
        }
    },
    watch: {
        customer: {
            handler(value) {
                let customer = {
                    name: value.name,
                    phone: value.phone,
                    address: value.address,
                    email: value.email
                }
                this.$emit('customerDetailChanged', customer)
            }, deep: true
        }
    }
}
</script>
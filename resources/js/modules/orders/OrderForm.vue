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
                <label for="">Email</label>
                <input type="text" class="form-control" v-model="customer.email">
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
                email: ''
            }
        }
    }
}
</script>
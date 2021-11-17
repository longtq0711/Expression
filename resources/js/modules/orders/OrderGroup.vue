<template>
    <div class="wrapper">
        <div class="row mb-3">
            <div class="col-md-12">
                <button @click="handleOrderSave" class="btn btn-success float-right">Save</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <h3>Customer details</h3>
                <order-form 
                    @customerDetailChanged="handleCustomerDetail"
                    :errors="errors"
                ></order-form>

                <h3>
                    Order details 
                    <span class="float-right" v-if="totalPrice > 0">{{ totalPrice }}</span>
                    <div class="validation-message" v-if="errors.items">{{ errors.items }}</div>
                </h3>
                <order-details :items="orderedItems"></order-details>
            </div>
            <div class="col-md-5">
                <h3 >Menu items</h3>
                
                <order-menu-items 
                    :items="menuItems"
                    @addMenuItem="handleNewItem"
                ></order-menu-items> 
            </div>
        </div>
    </div>
</template>

<script>
    import OrderForm from './OrderForm.vue';
    import OrderMenuItems from './OrderMenuItems.vue';
    import OrderDetails from './OrderDetails.vue';
    import axios from 'axios';

    export default {
        components: {
            OrderForm,
            OrderMenuItems,
            OrderDetails,
        },
        props: ['restoId'],
        data() {
            return {
                menuItems: [],
                orderedItems: [],
                originMenuItems: [],
                params: {
                    id: ''
                },
                customerDetails: [],
                errors: []
            }
        },
        created() {
            this.loadRestoMenuItems();
            window.eventBus.$on('addMenuItem', this.handleNewItem)
            window.eventBus.$on('filteredList', this.handlefilterSearch);
            window.eventBus.$on('clearfilteredList', this.clearfilterSearch);          
            window.eventBus.$on("removeOrderedItem", this.handleRemoveOrderedItem);
        },
        computed: {
           totalPrice() {
               let price = 0;
               this.orderedItems.forEach(order => {
                   price += order.price;
               })
               return price;
           }
        },
        methods: {
            checkValid() {
                let scop = this;
                scop.errors = [];
                if (!scop.customerDetails.name) {
                    scop.errors['name'] = 'Name is required';
                }
                if (!scop.customerDetails.phone) {
                    scop.errors['phone'] = 'Phone number is required';
                }
                if (!scop.customerDetails.address) {
                    scop.errors['address'] = 'Address is required';
                }
                if (scop.totalPrice == 0) {
                    scop.errors['items'] = 'Please choose one item to order';
                }
            },
            loadRestoMenuItems() {
                let scop = this;
                scop.params.id = scop.restoId;    
                scop.$loading(true);
                axios.get('/order/menu-items', {
                    params: scop.params
                }).then(response => {
                    if (response.data.status === 200) {
                        scop.menuItems = response.data.items;
                        scop.originMenuItems = response.data.items;
                        scop.$loading(false);
                    }
                }).catch(function (error) {
                    console.log(error)
                })
            },
            handleNewItem(item) {
                this.orderedItems.unshift(item);
            },
            handlefilterSearch(filterSearch) {
                this.menuItems = filterSearch;
            },
            clearfilterSearch() {
                this.menuItems = this.originMenuItems;
            },
            handleCustomerDetail(customer) {
                this.customerDetails = customer;
            },
            handleOrderSave() {
                let orderedItemsIds = [];
                this.orderedItems.forEach(item => {
                    orderedItemsIds.push(item.id);
                });
                let orderData = {
                    resto_id: this.restoId,
                    order_data: {
                        customerDetails: this.customerDetails,
                        totalPrice: this.totalPrice,
                        orderedItems: orderedItemsIds
                    }
                };
                this.checkValid();
                if (Object.keys(this.errors).length === 0) {
                    axios.post('/order/save', orderData).then(function(response) {
                        if(response.status == 200) {
                            Swal.fire({
                            icon: 'success',
                            title: '',
                            text: response.data.message,
                            }).then((result) => {
                                window.location.reload();
                            })
                        }
                    }).catch(error => console.log(error));

                }
            },
            handleRemoveOrderedItem(item) {
                this.orderedItems = this.orderedItems.filter(orderedItem => orderedItem.id != item.id);
            }
        }
    }
</script>
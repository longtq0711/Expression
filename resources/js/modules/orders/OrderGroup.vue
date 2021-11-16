<template>
    <div class="row">
        <div class="col-md-7">
            <h3>Customer details</h3>
            <order-form></order-form>

            <h3>
                Order details 
                <span class="float-right" v-if="totalPrice > 0">{{ totalPrice }}</span>
            </h3>
            <order-details :order-details="orderedItems"></order-details>
        </div>
        <div class="col-md-5">
            <h3 >Menu items</h3>
            
            <order-menu-items 
                :items="menuItems"
                @addMenuItem="handleNewItem"
            ></order-menu-items> 
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
            }
        },
        created() {
            this.loadRestoMenuItems();
            window.eventBus.$on('addMenuItem', this.handleNewItem)
            window.eventBus.$on('filteredList', this.handlefilterSearch);
            window.eventBus.$on('clearfilteredList', this.clearfilterSearch);          
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
            }
        }
    }
</script>
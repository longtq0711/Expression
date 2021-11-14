<template>
    <div class="wrapper menu__container">
        <div class="row">
            <div class="col-md-8">
                <card-component>
                    <template slot="title">My Menu Items</template>
                    <template slot="body">
                        <div class="section mb-3">
                            <label for="selector">Select a category</label>
                            <multiselect v-model="menu"
                                :options="categories"
                                :close-on-select="true">
                            </multiselect>
                        </div>
                        <div class="section">
                            <label for="selector">Menu items for this category</label>
                            <menu-group :items="currentMenuItems"></menu-group>
                        </div>
                    </template>
                </card-component>
            </div>
            <div class="col-md-4">
                <card-component>
                    <template slot="title">Add Menu Items</template>
                    <template slot="body">
                        <menu-add-form 
                            :categories="categories"
                            :resto-id="restoId"
                            @newItemAdded="addNewItem"
                        ></menu-add-form>
                    </template>
                </card-component>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    import MenuGroup from './MenuGroups.vue';
    import MenuAddForm from './MenuAddForm.vue';
    export default ({
        components: {
            Multiselect,
            MenuGroup,
            MenuAddForm
        },
        data() {
            return {
                menu: '',
                categories: [],
                localItems: ''
            }
        },
        props: {
            items: {
                type: Object,
                require: true
            },
            restoId: {
                type: Number,
            }
        },
        created() {
            let list = [];
            $.each(this.items, function(key, value) {
                list.push(key);
            });
            this.categories = list;
            this.localItems = this.items;
        },
        computed: {
            currentMenuItems() {
                return this.localItems[this.menu];
            }
        },
        methods: {
            addNewItem(item, category) {
                this.localItems[category].unshift(item);
            }
        }
    })
</script>

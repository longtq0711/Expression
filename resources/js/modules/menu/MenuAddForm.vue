<template>
  <div class="add_form__wrapper">
    <form v-on:submit.prevent="handleSubmit">
      <div class="form-group">
        <label for="name">Food item</label>
        <input class="form-control" type="text" placeholder="Enter food item name" v-model="food.name">
        <div class="validation-message" v-if="errors.name">{{ errors.name }}</div>
      </div>

      <div class="form-group">
        <label for="name">Select category</label>
        <multiselect
          v-model="food.category"
          :options="categories"
        ></multiselect>
        <div class="validation-message" v-if="errors.category">{{ errors.category }}</div>
      </div>

      <div class="form-group">
        <label for="name">Price</label>
        <input class="form-control" type="number" placeholder="Enter food item price" v-model="food.price">
        <div class="validation-message" v-if="errors.price">{{ errors.price }}</div>
      </div>

      <div class="form-group">
        <label for="name">Description</label>
        <textarea class="form-control" v-model="food.description" placeholder="Enter item description"></textarea>
        <div class="validation-message" v-if="errors.description">{{ errors.description }}</div>
      </div>

      <div class="form-group">
        <button class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</template>

<script>
import Multiselect from 'vue-multiselect';
import axios from 'axios';
export default {
    props: ['categories', 'restoId'],
    components: {
        Multiselect
    },
    data() {
        return {
            food: this.getBasicMenuItem(),
            errors: {},
        }
    },
    methods: {   
        checkValid: function () {
            let scop = this;
            scop.errors = [];

            if (!scop.food.name) {
                scop.errors['name'] = 'Name is required';
            }
            if (!scop.food.category) {
                scop.errors['category'] = 'Please choose category';
            }
            if (!scop.food.price) {
                scop.errors['price'] = 'Price is required';
            }
            if (!scop.food.description) {
                scop.errors['description'] = 'Description is required';
            }
        },    
        getBasicMenuItem() {
            return {
                name: '',
                category: '',
                price: '',
                description: ''
            }
        },
        handleSubmit() {
            let food = this.food;
            food.restoId = this.restoId;
            this.checkValid();

            if (Object.keys(this.errors).length == 0) {
                axios.post('/menus/saveItem', food).then(response => {
                this.$emit('newItemAdded', response.data.menu, food.category);
                this.food = this.getBasicMenuItem();
                }).catch(error => {
                if (error.response.status && error.response.status == 422) {
                    this.validation.setMessages(error.response.data.errors);
                }
                console.log('error', error);
                });
            }
        }
    }
}
</script>

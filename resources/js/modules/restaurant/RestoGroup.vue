<template>
  <div class="resto-group__wrapper mb-5">
    <div class="row">
      <div class="col-md-4 mb-4" v-for="resto in localResto" :key="resto.id">
        <card-component>
          <template slot="title">{{resto.name}}</template>
          <template slot="body">
            <div class="content-container">
              <i class="fa fa-map-marker"></i> {{resto.location}}
              <br>
              <i class="fa fa-table"></i> {{resto.table}}
            </div>
            <a class="card-link" v-bind:href="resto.slug">Menu</a>
            <a class="card-link" v-bind:href="resto.ordersSlug">Orders</a>
          </template>
        </card-component>
      </div>
      <div class="col-md-4" v-if="showAddForm">
        <card-component>
          <template slot="title">Add new Restaurant</template>
          <template slot="body">
            <div class="add-button-wrapper">
              <span @click="handleAddNewResto">
                <i class="fa fa-plus-circle fa-5x pointer"></i>
              </span>
            </div>
          </template>
        </card-component>
        <modal name="add-new-resto" height="70%">
          <div class="container-padding">
            <RestoAddForm
                @addRestoEvent="handleSaveResto"
                @modalCancel="handleCancelResto"
            ></RestoAddForm>
          </div>
        </modal> 
      </div>
    </div>
  </div>
</template>

<script>
import RestoAddForm from './RestoAddForm.vue';
import axios from 'axios';

export default {
  components: {
    RestoAddForm
  },
  props: ['restaurants'],
  created() {
    this.localResto = this.restaurants;
  },
  computed: {
    showAddForm() {
      return (this.localResto.length < 6) ? true : false;
    }
  },
  data() {
    return {
      localResto: []
    }
  },
  methods: {
    handleAddNewResto() {
      this.$modal.show('add-new-resto');
    },
    handleCancelResto() {
      this.$modal.hide('add-new-resto');
    },
    handleSaveResto(restoData) {
      axios.post('/restaurants/storeItem', restoData).then(response => this.localResto.unshift(response.data.restaurant));
      this.$modal.hide('add-new-resto');
    }
  }
}
</script>

<style lang="scss" scoped>
  .add-button-wrapper {
    text-align: center;
  }
  .content-container {
    height: 70px;
  }
</style>

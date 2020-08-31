<template>
  <div class="profile-page">
    <section class="section-profile-cover section-shaped my-0">
      <div class="shape shape-style-1 shape-primary shape-skew alpha-4">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </section>
    <section class="section section-skew">
      <div class="container">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header bg-white border-0">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h3 class="mb-0">Favorite movies</h3>
                    </div>
                  </div>
                </div>
                <div v-if="loading">Carregando...</div>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Overview</th>
                      <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="favorite in favorites" :key="favorite.id">
                      <td>
                        <img :src="'https://image.tmdb.org/t/p/w92/'+ favorite.movie.poster_path">
                      </td>
                      <td>{{ favorite.movie.title }}</td>
                      <td>{{ favorite.movie.overview }}</td>
                      <td class="td-actions text-right">
                        <button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-lg"
                                data-original-title=""
                                title="Remove movie from favorites"
                                v-on:click="destroy(favorite.id)">
                          <i class="ni ni-fat-remove pt-1"></i>
                        </button>
                      </td>
                    </tr>
                    <tr v-if="!favorites.length" class="text-center">
                      <td colspan="4">No Records Found.</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <paginator ref="paginator"
                           :origem="'favorites'"
                           :resource_url="resource_url"
                           @update="updateResource"></paginator>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>

import axios from "axios";
import app from '@/config/app';
import http from '@/config/http';
import Paginator from '@/components/Paginator';

export default {
  name: 'favorites',
  components: {
    Paginator
  },
  data() {
    return {
      resource_url: `${app.service.api}/api/favorites`,
      favorites: [],
      loading: true,
    };
  },
  mounted() {
    axios
        .get(`${app.service.api}/api/favorites`, {headers: http.header()})
        .then(response => {
          this.favorites = response.data.data;
        })
        .catch(error => {
          console.log(error)
        })
        .finally(() => this.loading = false)
  },

  methods: {
    updateResource(favorites) {
      this.favorites = favorites.data;
    },

    async destroy(id) {
      const {value: result} = await this.$swal.fire({
        title: 'Confirm deleting the movie from the favorites list?',
        text: '',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
      });
      if (result === true) {
        try {
          this.$http.delete(`${app.service.api}/api/favorites/destroy/${id}`, {headers: http.header()})
              .then((response) => {
                this.$refs.paginator.fetchData();
              }).catch((response) => {
            const processed = this.$response.process(response);
            this.$swal.fire(
                '',
                processed.message,
                'success',
            );
          });
        } catch (error) {
          const processed = this.$response.process(error.response);
          this.$swal.fire(
              'Oops!',
              processed.message,
              'error',
          );
        }
      }
    }
  }
};
</script>
<style></style>

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
                      <h3 class="mb-0">Movies</h3>
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
                    <tr v-for="movie in movies" :key="movie.id">
                      <td>
                        <img :src="'https://image.tmdb.org/t/p/w92/'+ movie.poster_path">
                      </td>
                      <td>{{ movie.title }}</td>
                      <td>{{ movie.overview }}</td>
                      <td v-if="!movie.favorite" class="td-actions text-right">
                        <button type="button" rel="tooltip" class="btn btn-success btn-icon btn-lg"
                                data-original-title=""
                                title="Add movie to favorites"
                                v-on:click="addFavorites(movie.id)">
                          <i class="ni ni-favourite-28"></i>
                        </button>
                      </td>
                      <td v-else class="td-actions text-right">
                        <span rel="tooltip" class="btn btn-danger btn-icon btn-lg"
                                data-original-title=""
                                title="Favorite movie">
                          <i class="ni ni-favourite-28"></i>
                        </span>
                      </td>
                    </tr>
                    <tr v-if="!movies.length" class="text-center">
                      <td colspan="4">No Records Found.</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <paginator ref="paginator"
                           :origem="'movies'"
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
  name: 'movies',
  components: {
    Paginator
  },
  data() {
    return {
      resource_url: `${app.service.api}/api/movies`,
      movies: [],
      loading: true,
    };
  },
  mounted() {
    axios
        .get(`${app.service.api}/api/movies`, {headers: http.header()})
        .then(response => {
          this.movies = response.data.data;
        })
        .catch(error => {
          console.log(error)
        })
        .finally(() => this.loading = false)
  },

  methods: {
    updateResource(movies) {
      this.movies = movies.data;
    },

    async addFavorites(id) {
      const {value: result} = await this.$swal.fire({
        title: 'Add movie to favorites?',
        text: '',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
      });
      if (result === true) {
        try {
          let data = {
            'movie_id': id
          };
          this.$http.post(`${app.service.api}/api/favorites/store`, data,{headers: http.header()})
              .then((response) => {
                this.$refs.paginator.fetchData();
              }).catch((response) => {
            const processed = this.$response.process(response);
            this.$swal.fire(
                'Oops!',
                processed.message,
                'error',
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

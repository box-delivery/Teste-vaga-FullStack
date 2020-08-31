<template>
  <div class="card-footer py-4">
    <nav v-if="(links && (links.prev || links.next))">
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <button class="page-link"
                  @click="fetchData(links.first)"
                  :disabled="!links.first">
            <span>
              <<
            </span>
          </button>
        </li>
        <li class="page-item">
          <button class="page-link"
                  @click="fetchData(links.prev)"
                  :disabled="!links.prev">
            <span>
              <
            </span>
          </button>
        </li>
        <li class="page-item text-center page-item-text">
          Página {{meta.current_page}} de {{meta.last_page}} ({{ meta.total }})
        </li>
        <li class="page-item">
          <button class="page-link"
                  @click="fetchData(links.next)"
                  :disabled="!links.next">
            <span>
              >
            </span>
          </button>
        </li>
        <li class="page-item">
          <button class="page-link"
                  @click="fetchData(links.last)"
                  :disabled="!links.last">
            <span>
              >>
            </span>
          </button>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import http from '@/config/http';

export default {
  props: {
    resource_url: {
      type: String,
      required: true,
    },
    origem: {
      type: String,
      required: false,
    },
  },

  data() {
    return {
      links: {
        first: null,
        last: null,
        next: null,
        prev: null,
      },
      meta: {
        current_page: null,
        last_page: null,
        total: null,
      },
    };
  },

  methods: {
    fetchData(pageUrl) {
      pageUrl = pageUrl || this.resource_url;

      if (pageUrl.indexOf('?') === -1) {
        pageUrl = pageUrl + '?t=' + Math.random();
      } else {
        pageUrl = pageUrl + '&t=' + Math.random();
      }

      this.$http.get(pageUrl, {headers: http.header()})
          .then((response) => {
            this.links.first = response.data.first_page_url;
            this.links.last = response.data.last_page_url;
            this.links.next = response.data.next_page_url;
            this.links.prev = response.data.prev_page_url;

            this.meta.current_page = response.data.current_page;
            this.meta.last_page = response.data.last_page;
            this.meta.total = response.data.total;

            const responsable = {
              data: response.data.data,
              total: this.total,
            };

            this.$emit('update', responsable);
          }).catch((response) => {
        const processed = this.$response.process(response);
        this.$toasted.global.error(processed.message);
      });
    },
  },

  watch: {
    resource_url() {
      this.fetchData();
    },

  },

  created() {
    this.fetchData();
  },
};
</script>
<style scoped>

.first {
  transform: rotate(180deg);
  display: inline-block;
}

.page-item-text {
  padding: 0.5em 10px;
}

.pagination {
  margin: 30px 0 10px 0;
}

</style>

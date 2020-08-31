<template>
  <section class="section section-shaped section-lg my-0">
    <div class="shape shape-style-1 bg-gradient-default">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="container pt-lg-md">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <card
            type="secondary"
            shadow
            header-classes="bg-white pb-5"
            body-classes="px-lg-5 py-lg-5"
            class="border-0"
          >
            <template>
              <div class="text-center text-muted mb-4" >
                <img style="width: 200px;" src="img/brand/logo.png" />
              </div>
              <form role="form">
                <base-input
                  v-model="name.value"
                  alternative
                  class="mb-3"
                  placeholder="Name"
                  addon-left-icon="ni ni-hat-3"
                >
                </base-input>

                <ul class="form-errors">
                  <li v-for="(error, index) in name.errors" :key="index">
                    {{ error }}
                  </li>
                </ul>

                <base-input
                  v-model="email.value"
                  alternative
                  class="mb-3"
                  placeholder="Email"
                  addon-left-icon="ni ni-email-83"
                >
                </base-input>

                <ul class="form-errors">
                  <li v-for="(error, index) in email.errors" :key="index">
                    {{ error }}
                  </li>
                </ul>

                <base-input
                  v-model="password.value"
                  alternative
                  type="password"
                  placeholder="Password"
                  addon-left-icon="ni ni-lock-circle-open"
                >
                </base-input>

                <ul class="form-errors">
                  <li v-for="(error, index) in password.errors" :key="index">
                    {{ error }}
                  </li>
                </ul>
                <div class="text-center">
                  <base-button type="primary" @click="submitForm" class="my-4"
                    >Create account</base-button
                  >
                </div>
              </form>
            </template>
          </card>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import Cookies from "../utils/Cookies";
import router from "../router.js";
import app from "@/config/app";

export default {
  data: () => ({
    email: {
      value: null,
      errors: []
    },
    name: {
      value: null,
      errors: []
    },
    password: {
      value: null,
      errors: []
    }
  }),
  methods: {
    validEmail: function(email) {
      const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    isValidForm() {
      this.name.errors = [];
      this.email.errors = [];
      this.password.errors = [];

      if (!this.email.value) {
        this.email.errors.push("Email required.");
      } else if (!this.validEmail(this.email.value)) {
        this.email.errors.push("Invalid email.");
      }

      if (!this.name.value) {
        this.name.errors.push("Username required.");
      }

      if (!this.password.value) {
        this.password.errors.push("Password required.");
      }

      if (
        this.password.errors.length ||
        this.email.errors.length ||
        this.name.errors.length
      ) {
        console.log(" *** Input errors");
        return false;
      }

      //console.log(' *** name  = ' + this.name.value );
      //console.log(' *** email = ' + this.email.value );
      //console.log(' *** pass  = ' + this.password.value );
      //return false;

      return true;
    },
    async submitForm() {
      if (!this.isValidForm()) {
        return;
      }

      const user = {
        name: this.name.value,
        email: this.email.value,
        password: this.password.value
      };

      fetch(`${app.service.api}/api/users/register`, {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, cors, *same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(user) // body data type must match "Content-Type" header
      })
        .then(res => res.json())
        .then(data => {
          const { errors, user } = data;

          if (errors) {
            for (let key in errors) {
              this[key].errors.push(errors[key]);
            }

            return;
          }

          this.$swal.fire(
              '',
              'User successfully registered.',
              'success',
          );

          if (user) {
            Cookies.create("new_user", this.email.value, null);
          }
          router.push("/login");
        });
    }
  }
};
</script>
<style></style>

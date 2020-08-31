import router from '@/router';

const Response = {
  unauthorized: (response) => {
    if (response && response.status === 403) {
      router.push({ name: 'unauthorized' });
    }
  },

  unauthenticated: (response) => {
    if (response && response.status === 401) {
      router.push({ name: 'login' });
    }
  },

  unprocessable: (response) => {
    if (response && response.status === 422) {
      let message = '';

      for (const i in response.data.errors) {
        if (Array.isArray(response.data.errors[i])) {
          for (const j in response.data.errors[i]) {
            if (Array.isArray(response.data.errors[i][j]) || response.data.errors[i][j] instanceof Object) {
              for (const property in response.data.errors[i][j]) {
                if (!message.includes(response.data.errors[i][j][property])) {
                  message += `${response.data.errors[i][j][property]}<br>`;
                }
              }
            } else {
              message += `${response.data.errors[i][j]}<br>`;
            }
          }
        } else {
          message += `${response.data.errors[i]}<br>`;
        }
      }

      response.message = message;
    } else if (typeof response === 'undefined') {
      response = {message: `Não foi possível verificar o status do retorno.`};
    }

    return response;
  },

  message: (response) => {
    if (response && response.data.data && response.data.data.message) {
      response.message = response.data.data.message;
    } else if (response && response.body && response.data.message) {
      response.message = response.data.message;
    } else if (response && response.data.message) {
      response.message = response.data.message;
    }

    return response;
  },

  process: (response_obj) => {
    Response.unauthorized(response_obj);
    Response.unauthenticated(response_obj);

    response_obj = Response.message(response_obj);
    response_obj = Response.unprocessable(response_obj);

    return response_obj;
  },
};

let response = Response;

Response.install = (Vue) => {
  Vue.prototype.$response = response;
};

export default Response;

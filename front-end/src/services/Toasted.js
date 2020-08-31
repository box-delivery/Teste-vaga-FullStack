import Toasted from 'vue-toasted';
import Vue from 'vue';

Vue.use(Toasted, {
  theme: 'toasted-primary',
  position: 'top-right',
  iconPack: 'material-design-icon',
  duration: 6000,
});

Vue.toasted.register(
  'error',
  message => message, {
    type: 'error',
    icon: 'close',
  },
);

Vue.toasted.register(
  'success',
  message => message, {
    type: 'success',
    icon: 'check',
  },
);

Vue.toasted.register(
  'show',
  data => message, {
    type: 'show',
    icon: 'check',
  },
);

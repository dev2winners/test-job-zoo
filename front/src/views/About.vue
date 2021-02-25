<template>
  <div class="about">
    <h1>This is an about page</h1>
    <b-button variant="success">Button</b-button>
    {{ coin }}
  </div>
</template>

<script>
export default {
  data() {
    return {
      coin: '',
    };
  },
  methods: {
    getAxios() {
      this.axios
        //.get(process.env.VUE_APP_BACKEND_URL + '/')
        .get('https://api.coindesk.com/v1/bpi/currentprice.json')
        .then((response) => (this.coin = response.data))
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getAxios();
  },
};
</script>

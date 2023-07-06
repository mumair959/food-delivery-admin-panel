var homeProdObj = new Vue({
    el: '#home_products',
    data() {
      return {
        products: [],
        api_url: 'https://www.pohnchadoo.pk/api/',
        img_url: 'https://www.pohnchadoo.pk/storage/'
      }
    },
    mounted () {
      axios
      .get(this.api_url+'get_home_products')
      .then(response => {
        this.products = response.data.products;
        console.log(response);
      })
    }
  })
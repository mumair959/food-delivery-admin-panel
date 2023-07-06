var homeCatObj = new Vue({
    el: '#home_categories',
    data() {
      return {
        categories: [],
        api_url: 'https://www.pohnchadoo.pk/api/',
        img_url: 'https://www.pohnchadoo.pk/storage/'
      }
    },
    mounted () {
      axios
        .get(this.api_url+'get_vendor_categories')
        .then(response => {
          this.categories = response.data.categories;
          console.log(response);
        })
    }
  })
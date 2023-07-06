var homeProdObj = new Vue({
    el: '#lg1',
    data() {
      return {
        user:{},
        api_url: 'http://www.pohnchadoo.pk/api/',
      }
    },
    methods:{
        loginUser: function() {
            axios.post(this.api_url+'customer_login', this.user)
            .then(function (response) {
              console.log(response);
            })
        }
    },
    mounted () {
      
    }
  })
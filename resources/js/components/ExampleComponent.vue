<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        Laravel Point...
                    </div>

                    <div v-for="post in posts">
                        {{ post.title }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {


        data(){
            return{
                posts:{}
            }
        },

        mounted() {
            //console.log('Component mounted.')
            this.najmun();
        },

        methods: {
            najmun(){

                // Make a request for a user with a given ID
                axios.get('http://jsonplaceholder.typicode.com/posts')
                  
                  .then(response => {
                    this.posts=response.data;
                  })

                  .then(function (response) {
                    // handle success
                    console.log(response);
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .finally(function () {
                    // always executed
                  });
            }

        }
    }
</script>

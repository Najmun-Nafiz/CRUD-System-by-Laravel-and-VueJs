<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Customer Component</div>

                    <div class="card-body">

                       <form>

	                        <div class="form-group row">
	                            <label for="name" class="col-md-4 col-form-label text-md-right">Customer Name</label>

	                            <div class="col-md-6">
	                                <input id="name" type="text" class="form-control" v-model="name" required autocomplete="name" autofocus>                                
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="phone" class="col-md-4 col-form-label text-md-right">Customer Phone</label>

	                            <div class="col-md-6">
	                                <input id="phone" type="text" class="form-control" v-model="phone" required autocomplete="phone" autofocus>                                
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="address" class="col-md-4 col-form-label text-md-right">Customer Address</label>

	                            <div class="col-md-6">
	                                <input id="address" type="text" class="form-control" v-model="address" required autocomplete="address" autofocus>                                
	                            </div>
	                        </div>

	                        <div class="form-group row mb-0">
	                            <div class="col-md-6 offset-md-4">
	                                <button type="submit" class="btn btn-primary" @click.prevent="customerSaveData()">
	                                    Save
	                                </button>
	                            </div>
	                        </div>

                    	</form>
                    </div>

                    <div class="card-body">
                    	<table class="table">
                    	  <thead class="thead-dark">
                    	    <tr>
                    	      <th scope="col">Id</th>
                    	      <th scope="col">Name</th>
                    	      <th scope="col">Phone</th>
                    	      <th scope="col">Address</th>
                    	      <th scope="col">Action</th>
                    	    </tr>
                    	  </thead>
                    	  <tbody>

                    	    <tr v-for="result in info">
                    	      <th scope="row">{{ result.id }}</th>
                    	      <td>{{ result.name }}</td>
                    	      <td>{{ result.phone }}</td>
                    	      <td>{{ result.address }}</td>
                    	      <td>
                    	      	<a :href=" 'customer-edit/'+result.id" class="btn btn-success">Edit</a>
                                <a class="btn btn-danger" @click.prevent="customerDeleteData(result.id, index)">Delete</a>
                    	      	
                    	      </td>
                    	    </tr>
                    	    
                    	  </tbody>
                    	</table>
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
                info:{},
                name:'',
                phone:'',
                address:''
            }
        },

        mounted() {
            console.log('Component mounted.')
            this.customerShowData();
        },

        methods: {

        	customerSaveData(){
        		console.log("It Works.");
        		// Optionally the request above could also be done as
        		axios.post('customer-save', {
        		    name: this.name,
        		    phone: this.phone,
        		    address: this.address
        		  })
        		  .then(function (response) {
        		    console.log(response, 'Data Collected');
        		    location.reload();
        		  })
        		  .catch(function (error) {
        		    console.log(error, 'error');
        		  });

        	},

            customerShowData(){

                // Make a request for a user with a given ID
                axios.get('/customer-list')
                  
                  .then(response => {
                    this.info=response.data;
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
            },


            customerDeleteData(id, index){

                alert('Are you want to delete this property...?')
                axios.post('/customer-delete/'+id, {

                })
                  
                  .then(function (response) {
                    location.reload();
                  })
                  .catch(function (error) {
                    console.log(error, 'error');
                  });
                  
            },

        }
    }
</script>

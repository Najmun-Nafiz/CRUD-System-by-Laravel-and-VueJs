<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Customer Component Update</div>

                    <div class="card-body">

                       <form>

	                        <div class="form-group row">
	                            <label for="name" class="col-md-4 col-form-label text-md-right">Customer Name</label>

	                            <div class="col-md-6">
	                                <input id="name" type="text" class="form-control" v-model="data.name" required autocomplete="name" autofocus>                                
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="phone" class="col-md-4 col-form-label text-md-right">Customer Phone</label>

	                            <div class="col-md-6">
	                                <input id="phone" type="text" class="form-control" v-model="data.phone" required autocomplete="phone" autofocus>                                
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="address" class="col-md-4 col-form-label text-md-right">Customer Address</label>

	                            <div class="col-md-6">
	                                <input id="address" type="text" class="form-control" v-model="data.address" required autocomplete="address" autofocus>                                
	                            </div>
	                        </div>

	                        <div class="form-group row mb-0">
	                            <div class="col-md-6 offset-md-4">
	                                <button type="submit" class="btn btn-primary" @click.prevent="customerUpdateData()">
	                                    Update
	                                </button>
	                            </div>
	                        </div>

                    	</form>
                    </div>



                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    	props: ['data'],
        data(){
            return{

                name:'',
                phone:'',
                address:''
            }
        },

        mounted() {
            console.log(this.data,'Component mounted.')
            
        },

        methods: {

        	customerUpdateData(){

        		axios.post('/customer-update/'+this.data.id, {
        		    name: this.data.name,
        		    phone: this.data.phone,
        		    address: this.data.address
        		  })
        		  .then(function (response) {
        		    console.log(response, 'Data Update');
        		    location = '/customer';
        		  })
        		  .catch(function (error) {
        		    console.log(error, 'error');
        		  });

        	},

           

        }
    }
</script>

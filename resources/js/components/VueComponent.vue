<template>

	<div class="customer">
		
		<div class="row justify-content-center">
		    <div class="col-md-12">
		        <div class="card">
		            <div class="card-header">
		            	<h4 class="card-title" style="float:left;">Customers</h4>
		            	
		            	<button @click="reload" style="float:right;" type="button" class="btn btn-primary">Reload</button>

		            	<button @click="create" style="float:right;" type="button" class="btn btn-success mr-2" >AddInfo</button>


		            	<!-- Modal -->
		            	<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">

		            	  <div class="modal-dialog" role="document">
		            	    <div class="modal-content">
		            	      <div class="modal-header">
		            	        <h5 class="modal-title" id="customerModalLabel">Modal title</h5>
		            	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            	          <span aria-hidden="true">&times;</span>
		            	        </button>
		            	      </div>
								
		            	      <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
		            	      <div class="modal-body">
									<alert-error :form="form"></alert-error>

								    <div class="form-group">
								      <label>Name</label>
								      <input v-model="form.name" type="text" name="name"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Name">

								      <has-error :form="form" field="name"></has-error>
								    </div>

								    <div class="form-group">
								      <label>Email</label>
								      <input v-model="form.email" type="email" name="email"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Email">

								      <has-error :form="form" field="email"></has-error>
								    </div>

								    <div class="form-group">
								      <label>Phone</label>
								      <input v-model="form.phone" type="text" name="phone"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }" placeholder="Phone">

								      <has-error :form="form" field="phone"></has-error>
								    </div>

								    <div class="form-group">
								      <label>Address</label>
								      <textarea v-model="form.address" name="address"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('address') }"></textarea>

								      <has-error :form="form" field="address"></has-error>
								    </div>

								    <div class="form-group">
								      <label>Total</label>
								      <input v-model="form.total" type="number" name="total"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('total') }" placeholder="Total">

								      <has-error :form="form" field="total"></has-error>
								    </div>

		            	      </div>

		            	      <div class="modal-footer">
		            	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		            	        <button :disabled="form.busy" type="submit" id="buttonText" class="btn btn-primary">SaveInfo</button>
		            	      </div>
							</form>
		            	      
		            	    </div>
		            	  </div>
		            	</div>
		            	
		            </div>

		            <div class="card-body">

		            	<div class="mb-3" >
		            		<div class="row">
		            			<div class="col-md-2">
		            				<strong>Search By : </strong>
		            			</div>
		            			<div class="col-md-3">
		            				<select v-model="queryField" class="form-control" id="field">
		            					<option value="name">Name</option>
		            					<option value="email">Email</option>
		            					<option value="phone">Phone</option>
		            					<option value="address">Address</option>
		            					<option value="total">Total</option>
		            				</select>
		            			</div>
		            			<div class="col-md-7">
		            				<input v-model="query" type="text" class="form-control" placeholder="Search">
		            			</div>
		            		</div>
		            	</div>
		                
		                <div class="table-responsive">
		                	<table class="table table-hover table-bordered table-striped">
		                	  <thead class="bg-danger">
		                	    <tr>
		                	      <th scope="col">Id</th>
		                	      <th scope="col">Name</th>
		                	      <th scope="col">Email</th>
		                	      <th scope="col">Phone</th>
		                	      <th scope="col">Address</th>
		                	      <th scope="col">Total</th>
		                	      <th class="text-center btn-secondary" scope="col" align="center">Action</th>
		                	    </tr>
		                	  </thead>
		                	  <tbody>

		                	    <tr v-show="customers.length" v-for="(result, index) in customers" :key="result.id">
		                	      <th scope="row">{{ index + 1 }}</th>
		                	      <td>{{ result.name }}</td>
		                	      <td>{{ result.email }}</td>
		                	      <td>{{ result.phone }}</td>
		                	      <td>{{ result.address }}</td>
		                	      <td>{{ result.total }}</td>

		                	      <td class="text-center">

		                	      	<button type="button" class="btn btn-info btn-sm">
		                	      		<i class="material-icons">remove_red_eye</i>
		                	      	</button>
		                	      	<button @click="edit(result)" type="button" class="btn btn-primary btn-sm"><i class="material-icons">edit</i>
		                	      	</button>
		                	      	<button @click="destroy(result)"  type="button" class="btn btn-danger btn-sm">
		                	      		<i class="material-icons">delete_sweep</i>
		                	      	</button>

		                	      </td>
		                	    </tr>

		                	    <tr v-show="!customers.length">
		                	    	<td colspan="6"><div class="alert alert-danger" role="alert">Not Data Found...!</div></td>
		                	    </tr>
		                	    
		                	  </tbody>
		                	</table>

		                	<pagination-component v-if="pagination.last_page > 1" 
								
								:pagination="pagination"
								:offset="5"
								@paginate="query === '' ? getData() : searchData()"

		                		></pagination-component>
		                </div>


		            </div>
		        </div>
		    </div>
		</div>

		<!--Delete Modal -->
		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="deleterModalLabel">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form @submit.prevent="anamul()" @keydown="form.onKeydown($event)">
		      <div class="modal-body">
		        <h5 class="card-title">Are you sure ?</h5>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		        <button :disabled="form.busy" type="submit" class="btn btn-primary">Yes</button>
		      </div>
		  	</form>
		    </div>
		  </div>
		</div>


		<vue-snotify></vue-snotify>

	</div>
</template>

<script>
    export default {

    	data(){
    		return{
    			editMode: false,
    			query: '',
    			queryField: 'name',
    			customers: [],
    			form: new Form({ 
    				id: '',
    				name: '',
    				email: '',
    				phone: '',
    				address: '',
    				total: '',
    			 }),
    			pagination:{
    				current_page: 1,
    			}
    		}
    	},

    	watch: {
    		query:function(newQ, old){
    			if(newQ === ''){
    				this.getData();
    			}
    			else{
    				this.searchData()
    			}
    		}
    	},

        mounted() {
            this.getData();
        },

        methods: {
        	getData(){

        		axios.get('/api/vue?page='+this.pagination.current_page)
        		.then(response => {
        			this.customers=response.data.data;
        			this.pagination=response.data.meta;
        		})

        		.catch(e => {
        			console.log(e);
        		})
        	},

        	searchData(){
        		axios.get('/api/search/customers/'+this.queryField+'/'+this.query+'?page='+this.pagination.current_page)

        		.then(response => {
        			this.customers=response.data.data;
        			this.pagination=response.data.meta;
        		})

        		.catch(e => {
        			console.log(e)
        		})
        	},

        	reload(){
        		this.getData()
        		this.query = ''
        		this.queryField = 'name'
        		this.$snotify.success('Data Successfully Reloaded...','Reload')
        	},

        	create(){
        		this.editMode = false;
        		$('#customerModal').modal('show');
        		$('#buttonText').text('Insert');
        		$('#customerModalLabel').text('Add Customer Info..');
        		this.form.reset();
        		this.form.clear();
        	},

        	store(){
        		this.form.busy = true;
        		this.form.post('/api/vue')

        		.then(response => {
        			this.getData()
        			$('#customerModal').modal('hide');

        			if(this.form.successful){
        				this.$snotify.success('Data Successfully Reloaded...')
        			}
        			else{
        				this.$snotify.error('Something is errror..!')
        			}
        		})

        		.catch(e => {
        			console.log(e)
        		})
        	},

        	edit(result){
        		this.editMode = true;
        		this.form.reset();
        		this.form.clear();
        		this.form.fill(result)
        		$('#customerModal').modal('show');
        		$('#buttonText').text('Update');
        		$('#customerModalLabel').text('Update Customer Info..');
        	},

        	update(){
        		this.form.busy = true;
        		this.form.put('/api/vue/'+this.form.id)

        		.then(response => {
        			this.getData()
        			$('#customerModal').modal('hide');

        			if(this.form.successful){
        				this.$snotify.success('Data Updated Successfully Reloaded...')
        			}
        			else{
        				this.$snotify.error('Something is errror..!')
        			}
        		})

        		.catch(e => {
        			console.log(e)
        		})
        	},

        	destroy(result){
        		this.form.reset();
        		this.form.clear();
        		this.form.fill(result)
        		$('#deleteModal').modal('show');
        		$('#deleterModalLabel').text('Delete Customer Info..');
        	},

        	anamul(){
        		this.form.busy = true;
        		this.form.delete('/api/vue/'+this.form.id)

        		.then(response => {
        			this.getData()
        			$('#deleteModal').modal('hide');

        			if(this.form.successful){
        				this.$snotify.success('Data Deleted Successfully Reloaded...')
        			}
        			else{
        				this.$snotify.error('Something is errror..!')
        			}
        		})

        		.catch(e => {
        			console.log(e)
        		})
        	}

        	

        	// destroy(result) {
        	//   this.$snotify.clear();
        	//   this.$snotify.confirm(
        	//     "You will not be able to recover this data!",
        	//     "Are you sure?",
        	//     {
        	//       closeOnClick: false,
        	//       pauseOnHover: true,
        	//       buttons: [
        	//         {
        	//           text: "Yes",
        	//           action: toast => {
        	//             this.$snotify.remove(toast.id);
        	//             axios.delete("/api/vue/" + result.id)

        	//               .then(response => {
        	//                 this.getData();
        	//                 this.$snotify.success("Customer Successfully Deleted","Success");
        	//               })

        	//               .catch(e => {
        	//                 console.log(e);
        	//               });
        	//           },
        	//           bold: true
        	//         },
        	//         {
        	//           text: "No",
        	//           action: toast => {
        	//             this.$snotify.remove(toast.id);
        	//           },
        	//           bold: true
        	//         }
        	//       ]
        	//     }
        	//   );
        	// }

        	

        }
    }
</script>

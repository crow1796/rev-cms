<script type="text/javascript">
	export default {
		created(){
			this.$http
				.get("{base_url}/api/revcms/developer/mvc/controllers")
				.then(function(response){
					this.controllers = response.data;
					console.log(this.controllers);
				}.bind(this));
		},
		props: [
			'base_path'
		],
		data(){
			return {
				showMakeForm: false,
				makeBtnText: 'Make',
				newController: {},
				controllers: []
			};
		},
		methods: {
			toggleMakeForm(){
				this.showMakeForm = !this.showMakeForm;
				if(!this.showMakeForm){
					this.makeBtnText = 'Make';
					return false;
				}
				this.makeBtnText = 'Cancel';
			},
			makeController(){
				this.$http
					.post("{base_url}/api/revcms/developer/mvc/controllers/make", this.newController)
					.then(function(response){
						if(response.status == 200){
							// Success
							swal(
								'Success',
								'Controller has been created successfully.',
								'success'
								)
							this.newController = {}
						}
					}.bind(this));
			}
		}
	}
</script>

<template>
	<div class="rev-controllers">
		<div class="view-nav">
			<a href="#" 
				class="rev-btn -md -flat"
				:class="{ '-primary': !showMakeForm, '-danger': showMakeForm }"
				@click.prevent="toggleMakeForm()">
				{{ makeBtnText }}
			</a>
			<div class="right">
				<form class="search-form">
					<div class="rev-input-group">
						<input type="text" name="s" id="s" placeholder="Search controller here..." class="rev-field -md">
						<button type="submit" class="rev-btn -md -primary">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</form>
			</div>
		</div>
		<div class="view-nav"
				v-if="showMakeForm">
			<form class="_inline-block"
					@submit.prevent="makeController">
				php artisan make:controller 
				<div class="rev-field-group -xs">
					<input type="text" name="controller_name" id="controller_name" placeholder="Name" class="rev-field -md -flat" v-model="newController.name">
				</div>
				<div class="rev-field-group -xs">
					<label for="resource">
						<input type="checkbox" name="resource" id="resource" class="rev-checkbox -primary _no-margin" v-model="newController.resource" autocomplete="off">
						Resource
					</label>
				</div>
				<div class="rev-field-group -xs">
					<button type="submit" class="rev-btn -md -primary -flat">
						Make
					</button>
				</div>
			</form>
		</div>

		<div v-for="controller in controllers">
			{{ controller }}
		</div>
	</div>
</template>
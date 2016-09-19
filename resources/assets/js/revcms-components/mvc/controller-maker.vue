<script type="text/javascript">
	export default{
		created(){
			this.populateControllers();
		},
		props: ['controllers'],
		data(){
			return {
				showMakeForm: false,
				newController: {}
			};
		},
		methods: {
			toggleMakeForm(){
				this.showMakeForm = !this.showMakeForm;
			},
			makeController(){
				$('.rev-spinner-wrapper')
					.fadeIn('fast');
				this.$http
					.post("{admin_base_url}/api/revcms/developer/mvc/controllers/make", this.newController)
					.then((response) => {
						if(response.status == 200){
							// Success
							swal(
								'Success',
								'Controller has been created successfully.',
								'success'
								)
							this.newController = {};
							this.populateControllers();
							this.showMakeForm = !this.showMakeForm;
						}
						$('.rev-spinner-wrapper')
							.fadeOut('fast');
					});
			},
			populateControllers(){
				$('.rev-spinner-wrapper')
					.fadeIn('fast');
				this.$http
					.get("{admin_base_url}/api/revcms/developer/mvc/controllers")
					.then((response) => {
						this.controllers = _.map(response.data, function(controller){
							controller.selected = false;
							return controller;
						});
						$('.rev-spinner-wrapper')
							.fadeOut('fast');
					});
			}
		},
		computed: {
			makeBtnText(){
				return this.showMakeForm ? 'Cancel': 'Make';
			}
		}
	}
</script>

<template>
	<button type="button"
		class="rev-btn -md -danger"
		:class="{ '-toggled': showMakeForm }"
		@click.prevent="toggleMakeForm()">
		{{ makeBtnText }}
	</button>

	<div class="view-nav _floating-form animated _rev-radius"
			transition="rev-bounce"
			v-if="showMakeForm">
		<form class="_inline-block"
				@submit.prevent="makeController">
			php artisan make:controller 
			<div class="rev-field-group -xs">
				<input type="text" name="controller_name" id="controller_name" placeholder="Name" class="rev-field -md -flat" v-model="newController.name">
			</div>
			<div class="rev-field-group -xs">
				<label for="resource">
					<input type="checkbox" name="resource" id="resource" class="rev-checkbox -danger _no-margin" v-model="newController.resource" autocomplete="off">
					Resource
				</label>
			</div>
			<div class="rev-field-group -xs text-right">
				<button type="submit" class="rev-btn -md -danger">
					Make
				</button>
			</div>
		</form>
	</div>
</template>
<script type="text/javascript">
	export default{
		created(){
			this.populateControllers();
		},
		props: {
			controllers: {},
			size: {
				default: '-md'
			}
		},
		data(){
			return {
				showMakeForm: false,
				newController: {},
				nameFailed: false
			};
		},
		methods: {
			toggleMakeForm(){
				this.showMakeForm = !this.showMakeForm;
			},
			makeController(){
				if(this.newController.name.trim() == ''){
					this.nameFailed = true;
					return false;
				}
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
		class="rev-btn -default -has-icon-right"
		:class="[{ '-toggled': showMakeForm }, size]"
		@click.prevent="toggleMakeForm()">
		{{ makeBtnText }}
		<span class="icon">
			<i class="revicon-document-add"></i>
		</span>
	</button>

	<div class="view-nav _floating-form animated _rev-radius"
			transition="rev-bounce"
			v-if="showMakeForm">
		<form class="_inline-block"
				@submit.prevent="makeController">
			php artisan make:controller 
			<div class="rev-field-group -xs">
				<input type="text" 
						name="controller_name" 
						id="controller_name" 
						placeholder="Name" 
						:class="{ '-error': nameFailed }"
						class="rev-field -md" 
						v-model="newController.name"
						required>
			</div>
			<div class="rev-field-group -xs">
				<label for="resource">
					<input type="checkbox" name="resource" id="resource" class="rev-checkbox -danger _no-margin" v-model="newController.resource" autocomplete="off">
					Resource
				</label>
			</div>
			<div class="rev-field-group -xs text-right">
				<button type="submit" class="rev-btn -md -danger -has-icon-right">
					Make
					<span class="icon">
						<i class="revicon-document-add"></i>
					</span>
				</button>
			</div>
		</form>
	</div>
</template>
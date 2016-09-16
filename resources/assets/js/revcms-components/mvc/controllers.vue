<script type="text/javascript">
	export default {
		created(){
			this.populateControllers();
		},
		props: [
			'base_path'
		],
		data(){
			return {
				showMakeForm: false,
				makeBtnText: 'Make',
				newController: {},
				controllers: [],
				selectionMode: false,
				selections: []
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
							this.populateControllers()
						}
					}.bind(this));
			},
			toggleSelectionMode(){
				this.selectionMode = !this.selectionMode;
			},
			selectController(controller){
				if(this.selectionMode){
					controller = _.merge(controller, {
						selected: controller.selected ? !controller.selected : true
					});
					this.controllers.$set(this.controllers.indexOf(controller), controller);
					if(controller.selected){
						this.selections.push(controller);
						return true;
					}
					this.selections.$remove(controller);
					return true;
				}

			},
			populateControllers(){
				this.$http
					.get("{base_url}/api/revcms/developer/mvc/controllers")
					.then(function(response){
						this.controllers = response.data;
					}.bind(this));
			}
		},
		computed: {
			selectionModeText(){
				return this.selectionMode ? 'On': 'Off';
			}
		}
	}
</script>

<template>
	<div class="rev-controllers">
		<div class="view-nav _relative">
			<div class="rev-input-group">
				<button type="button"
					class="rev-btn -md"
					:class="{ '-primary': !showMakeForm, '-danger': showMakeForm }"
					@click.prevent="toggleMakeForm()">
					{{ makeBtnText }}
				</button>
				<button type="button" 
						class="rev-btn -md -success"
						:class="{ '-toggled': selectionMode }"
						@click="toggleSelectionMode()">
					Selection Mode : {{ selectionModeText }}
				</button>
				<button type="button" 
						class="rev-btn -md -danger"
						v-if="selectionMode && selections.length > 0">
					Delete
				</button>
			</div>
			<div class="view-nav _floating-form"
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
					<div class="rev-field-group -xs text-right">
						<button type="submit" class="rev-btn -md -primary -flat">
							Make
						</button>
					</div>
				</form>
			</div>	
		</div>

		<div class="row">
			<div class="col-sm-5">
			<div class="text-right">
				<form class="search-form">
					<div class="rev-input-group">
						<input type="text" name="s" id="s" placeholder="Search controller here..." class="rev-field -md">
						<button type="submit" class="rev-btn -md -primary">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</form>
			</div>
				<ul class="rev-list-group list-group _height-scroll" id="controller-list">
					<li class="list-group-item"
						 v-for="controller in controllers"
						 :class="{ '-active': controller.selected }">
					 	<a href="#"
					 		@click.prevent="selectController(controller)">
					 		{{ controller.name }}
					 		<div class="path">
					 			<small>
					 				{{ controller.path }}
					 			</small>
					 		</div>
					 	</a>
					 </li>
				</ul>
			</div>
		</div>
	</div>
</template>
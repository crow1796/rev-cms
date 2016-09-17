<script type="text/javascript">
	export default {
		created(){
			this.populateControllers();
		},
		ready(){
			var controllerEditor = ace.edit("controller-editor");
			controllerEditor
					.setTheme("ace/theme/monokai");
			controllerEditor.getSession().setUseWrapMode(true);
			controllerEditor.getSession().setMode("ace/mode/php");
			this.controllerEditor = controllerEditor;
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
				selections: [],
				selectedController: null,
				controllerEditor: null
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
				$('.rev-spinner-wrapper')
					.fadeIn('fast');
				this.$http
					.post("{base_url}/api/revcms/developer/mvc/controllers/make", this.newController)
					.then((response) => {
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
						$('.rev-spinner-wrapper')
							.fadeOut('fast');
					});
			},
			toggleSelectionMode(){
				this.selectedController = null;
				this.selectionMode = !this.selectionMode;
				if(!this.selectionMode){
					this.selections = [];
					for(var i = 0; i < this.controllers.length; i++){
						this.controllers[i].selected = false;
					}
				}
			},
			selectController(controller){
				if(this.selectionMode){
					controller.selected = !controller.selected;
					this.controllers.$set(this.controllers.indexOf(controller), controller);
					if(controller.selected){
						this.selections.push(controller);
						return true;
					}
					this.selections.$remove(controller);
					return true;
				}
				$('.rev-spinner-wrapper')
					.fadeIn('fast');
				this.selectedController = controller;
				$.ajax({
					'url': base_url + "/api/revcms/developer/mvc/controllers/get-content",
					'type': 'GET',
					data: {
						file_path: controller.path
					},
					success: (response) => {
						this.controllerEditor.setValue(response, 1);
						setTimeout(function(){
							$('.rev-spinner-wrapper')
								.fadeOut('fast');
							}, 500);
					}
				})
				// this.$http
				// 	.get("{base_url}/api/revcms/developer/mvc/controllers/get-content?file_path")
				// 	.then((response) =>{
				// 		console.log(response);
				// 	});
			},
			deleteSelectedItems(){
				this.sweetConfirm(() => {
					this.controllers = _.difference(this.controllers, this.selections);
					this.selections = [];	
					swal(
						'Success',
						'Controller(s) has been deleted successfully.',
						'success'
						);
				}, (dismiss) => {
					swal(
						'Cancelled',
						'Your controllers are safe.',
						'warning'
						);
				});
			},
			deleteSelectedController(){
				this.sweetConfirm(() => {
					this.controllers.$remove(this.selectedController);
					swal(
						'Success',
						'Controller has been deleted successfully.',
						'success'
						);
				}, (dismiss) => {
					swal(
						'Cancelled',
						'Your controller is safe.',
						'warning'
						);
				});
			},
			selectAllItems(){
				// Unselect all
				if(this.selections.length){
					this.controllers = _.map(this.controllers, function(controller){
						controller.selected = false;
						return controller;
					});
					this.selections = [];
					return false;
				}
				// Select all
				this.controllers = _.map(this.controllers, function(controller){
					controller.selected = true;
					return controller;
				});
				this.selections = this.controllers;
			},
			sweetConfirm: function(yes, no){
				swal({
					title: 'Confirm Delete',
					text: "You won't be able to revert this.",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, do it!',
					cancelButtonText: 'No, cancel!',
					buttonsStyling: true
				})
				.then(function(){
					yes();
				}, 
				function(dismiss){
					no(dismiss);
				});
			},
			populateControllers(){
				$('.rev-spinner-wrapper')
					.fadeIn('fast');
				this.$http
					.get("{base_url}/api/revcms/developer/mvc/controllers")
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
			selectionModeText(){
				return this.selectionMode ? 'On': 'Off';
			},
			hasSelectedController(){
				return this.selectedController != null && this.selectedController != {};
			},
			selectAllText(){
				var text = 'Unselect All';
				if(this.selections.length < this.controllers.length){
					text = 'Select All';
				}
				return text;
			}
		}
	}
</script>

<template>
	<div class="rev-controllers">
		<div class="view-nav _relative">
			<button type="button"
				class="rev-btn -md -danger"
				:class="{ '-toggled': showMakeForm }"
				@click.prevent="toggleMakeForm()">
				{{ makeBtnText }}
			</button>
			<button type="button" 
					class="rev-btn -md -danger"
					:class="{ '-toggled': selectionMode }"
					@click="toggleSelectionMode()">
				Selection Mode : {{ selectionModeText }}
			</button>
			<button type="button"
					class="rev-btn -md -danger"
					@click="selectAllItems()"
					v-if="selectionMode && controllers.length"
					title="{{ selectAllText }}">
				<i class="fa"
					:class="{ 'fa-square-o': selections.length, 'fa-check-square-o': selections.length < controllers.length }"></i>
			</button>
			<button type="button" 
					class="rev-btn -md -danger"
					v-if="selectionMode && selections.length > 0"
					@click="deleteSelectedItems()">
				Delete
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
		</div>

		<div class="row">
			<div class="col-sm-5">
				<div class="text-right">
					<input type="text" name="s" id="s" placeholder="Search controller here..." class="rev-field -md" v-model="controllerSearch">
				</div>
				<ul class="rev-list-group list-group _height-scroll _rev-radius" id="controller-list">
					<li class="list-group-item" v-if="!controllers.length">
						<a href="#" 
							class="text-center"
							@click.prevent="">
							You have no controller(s).
						</a>
					</li>
					<li class="list-group-item"
						 v-for="controller in controllers | filterBy controllerSearch in 'name'"
						 :class="{ '-active': controller.selected || controller == selectedController }">
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
			<div class="col-sm-7 animated"
				transition="rev-bounce"
				v-show="hasSelectedController">
				<div style="margin-top: 1px; margin-bottom: 7px;">
					<button type="button" class="rev-btn -md -success" title="Save Changes">
						<i class="fa fa-save"></i>
					</button>
					<button type="button" class="rev-btn -md -default" title="Reload Controller">
						<i class="fa fa-refresh"></i>
					</button>
					<button type="button" 
							class="rev-btn -md -danger pull-right" 
							title="Delete Controller"
							@click="deleteSelectedController()">
						<i class="fa fa-trash"></i>
					</button>
				</div>
				<div id="controller-editor" class="_rev-editor-height"></div>
			</div>
		</div>
	</div>
</template>
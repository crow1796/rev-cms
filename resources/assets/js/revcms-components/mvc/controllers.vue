<script type="text/javascript">
	export default {
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
				controllers: [],
				selectionMode: false,
				selections: [],
				selectedController: null,
				controllerEditor: null
			};
		},
		methods: {
			toggleSelectionMode(){
				this.selectedController = null;
				this.selectionMode = !this.selectionMode;
				this.controllerEditor.setValue('');
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
				showRevLoader();
				this.selectedController = controller;
				$.ajax({
					'url': base_url + "/api/revcms/developer/mvc/controllers/get-content",
					'type': 'GET',
					data: {
						file_path: controller.path
					},
					success: (response) => {
						this.controllerEditor.setValue(response, 1);
						hideRevLoader();
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
					showRevLoader();
					this.requestToDeleteControllers(this.selections)
						.then((response) => {
							this.controllers = _.difference(this.controllers, this.selections);
							this.selections = [];
							swal(
								'Success',
								'Controller(s) has been deleted successfully.',
								'success'
								);
							hideRevLoader();
						});
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
					showRevLoader();
					this.requestToDeleteControllers(this.selectedController)
						.then((response) => {
							this.controllers.$remove(this.selectedController);
							this.controllerEditor.setValue('');
							this.selectedController = null;
							swal(
								'Success',
								'Controller has been deleted successfully.',
								'success'
								);
							hideRevLoader();
						});
				}, (dismiss) => {
					swal(
						'Cancelled',
						'Your controller is safe.',
						'warning'
						);
				});
			},
			saveChanges(){
				var url = "{base_url}/api/revcms/developer/mvc/controllers/update-controller";
				var newContent = this.controllerEditor.getValue();
				showRevLoader();
				this.$http.post(url, {
					_method: 'PATCH',
					path: this.selectedController.path,
					content: newContent
				})
				.then((response) => {
					swal(
						'Success',
						'Controller has been updated successfully.',
						'success'
						);
					hideRevLoader();
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
				this.selections = _.clone(this.controllers);
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
			requestToDeleteControllers(controllers){
				var controllersPath = [];
				var controllerDeleteUrl = "{base_url}/api/revcms/developer/mvc/controllers/delete-controller"
				if(controllers.length){
					for(var i = 0; i < controllers.length; i++){
						controllersPath.push(controllers[i].path);
					}
				}else {
					controllersPath = controllers.path;
				}
				return this.$http.post(controllerDeleteUrl, {
					paths: controllersPath
				})
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
			<rev-controller-maker :controllers.sync="controllers"></rev-controller-maker>
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
		</div>

		<div class="row">
			<div class="col-sm-5">
				<div class="text-right" style="margin-bottom: 8px;">
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
					<button type="button" 
							class="rev-btn -md -success" 
							title="Save Changes"
							@click="saveChanges()">
						<i class="fa fa-save"></i>
					</button>
					<span class="pull-right">
						<button type="button" 
								class="rev-btn -md -default" 
								title="Reload Controller"
								@click="selectController(selectedController)">
							<i class="fa fa-refresh"></i>
						</button>
						<button type="button" 
								class="rev-btn -md -danger" 
								title="Delete Controller"
								@click="deleteSelectedController()">
							<i class="fa fa-trash"></i>
						</button>
					</span>
				</div>
				<div id="controller-editor" class="_rev-editor-height"></div>
			</div>
		</div>
	</div>
</template>
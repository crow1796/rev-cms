<script>
	export default{
		created(){
			this.populateControllers();
			this.populateLayouts();
		},
		ready(){
			this.actionEditor = ace.edit("action-editor");
			this.actionEditor
					.setTheme("ace/theme/monokai");
			this.actionEditor.getSession().setUseWrapMode(true);
			this.actionEditor.getSession().setMode({
				path: "ace/mode/php",
				inline: true
			});
			this.actionEditor.setOptions({
				fontSize: "13pt",
				enableEmmet: false
			});

			this.viewEditor = ace.edit("view-editor");
			this.viewEditor
					.setTheme("ace/theme/monokai");
			this.viewEditor.getSession().setUseWrapMode(true);
			this.viewEditor.getSession().setMode({
				path: "ace/mode/html",
				inline: true
			});
			this.viewEditor.setOptions({
				fontSize: "13pt",
				enableEmmet: true
			});
		},
		props: {
			pagedata : {
				default: null
			}
		},
		data(){
			return {
				baseUrl: base_url,
				controllers: [],
				actionEditor: null,
				viewEditor: null,
				page: {
					meta: {}
				},
				permalink_editing: false
			}
		},
		methods: {
			savePage(){
				this.page.action_source = this.actionEditor.getValue();
				this.page.view_source = this.viewEditor.getValue();
				toastr.remove();
				showRevLoader();
				this.$http
					.post("{admin_base_url}/api/revcms/pages/store", this.page)
					.then((response) => {
						let responseData = response.data;
						toastr.options = {
							positionClass: 'toast-bottom-right',
							timeout: 5000,
							extendedTimeOut: 2500
						}
						if(responseData.failed){
							delete responseData.failed
							for(let counter = 0; counter < Object.keys(responseData).length; counter++){
								toastr.error(responseData[counter], 'Oops!');
							}
							hideRevLoader();
							return false;
						}
						swal(
							'Success',
							'Page Saved!',
							'success'
							);
						hideRevLoader();
					});
			},
			populateControllers(){
				showRevLoader();
				this.$http
					.get("{admin_base_url}/api/revcms/developer/mvc/controllers")
					.then((response) => {
						this.controllers = _.map(response.data, function(controller){
							controller.selected = false;
							return controller;
						});
						hideRevLoader();
					});
			},
			populateLayouts(){
				// showRevLoader();
				// this.$http
				// 	.get("{admin_base_url}/api/revcms/developer/mvc/controllers")
				// 	.then((response) => {
				// 		this.controllers = _.map(response.data, function(controller){
				// 			controller.selected = false;
				// 			return controller;
				// 		});
				// 		hideRevLoader();
				// 	});
			},
			togglePermalinkEdit(){
				this.permalink_editing = !this.permalink_editing;
			},
			updatePermalink(){
				if(this.page.slug.trim() == '') return false;
				this.permalink_editing = false;	
			},
			generateFields(){
				this.$http
					.get("{admin_base_url}/api/revcms/pages/generate-fields?page_title=" + this.page.title)
					.then((response) => {
						this.$set('page.slug', response.data.slug);
						this.$set('page.action_name', response.data.action_name);
					});
			}
		}
	}
</script>

<style type="text/css">
	#page-slug{
		font-weight: normal;
	}

	#permalink{
		height: 29px;
	}
</style>

<template>
	<form @submit.prevent="savePage()" action="">
		<div class="row" style="margin-top: 10px;">
			<div class="col-sm-6">
				<div class="rev-field-group _no-margin-left _no-margin-right row">
					<div class="col-sm-12">
						<label for="page_title">Title</label>
						<input type="text" 
								name="page_title" 
								id="page_title" 
								placeholder="Page Title *" 
								class="rev-field -lg _block"
								v-model="page.title"
								@blur="generateFields()">
					</div>
				</div>
				<div class="rev-field-group _no-margin-left _no-margin-right row" id="permalink">
					<div class="col-sm-12">
						<label for="permalink">
							Permalink: <span id="page-slug">
								{{ baseUrl + '/' }}<span v-if="!permalink_editing">{{ page.slug ? page.slug.trim('/') : '' }}</span>
							</span>
							<input type="text" 
									name="page_slug" 
									id="page_slug" 
									class="rev-field -xs"
									v-model="page.slug"
									v-if="permalink_editing">
							<button type="button" 
									class="rev-btn -sm -danger"
									v-if="permalink_editing"
									@click="updatePermalink()">
								Save
							</button>
							<button type="button" 
									class="rev-btn -sm -primary"
									@click="togglePermalinkEdit()">
								{{ permalink_editing ? 'Cancel' : 'Edit' }}
							</button>
						</label>
					</div>
				</div>
				<div class="rev-field-group _no-margin-left _no-margin-right row _relative">
					<div class="col-sm-12">
						<label for="controller">Controller</label>
						<div class="_inline-block">
							<rev-controller-maker 
								:controllers.sync="controllers"
								size="-sm"></rev-controller-maker>
						</div>
					</div>
				</div>
				<div class="rev-field-group _no-margin-left _no-margin-right row">
					<div class="col-sm-6">
						<select class="rev-field -lg _block"
								name="controller" 
								id="controller"
								v-model="page.controller">
							<option selected disabled hidden value="">Select a Controller *</option>
							<option 
								value="{{ controller.name }}"
								v-for="controller in controllers">
								{{ controller.name }}
							</option>
						</select>
					</div>
					<div class="col-sm-6">
						<input type="text" 
								name="action_name" 
								id="action_name" 
								placeholder="Action Name *" 
								class="rev-field -lg _block"
								v-model="page.action_name">
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="rev-field-group _no-margin-left _no-margin-right row">
					<div class="col-sm-12">
						<label for="layout">
							Page Layout *
						</label>
						<select class="rev-field -lg _block"
								name="layout" 
								id="layout"
								v-model="page.layout">
							<option selected disabled hidden value="">Select Layout *</option>
							<option value="default">Default</option>
						</select>
					</div>
				</div>
				<div class="rev-field-group _no-margin-left _no-margin-right row text-right">
					<div class="col-sm-12">
						<label for="hidden_page"
								title="Hidden pages are accessible only by logged-in back-end users"
								class="pull-left">
							<input type="checkbox" 
									name="hidden_page" 
									id="hidden_page"
									class="rev-checkbox -danger _no-margin"
									v-model="page.hidden">
							Hidden?
						</label>
						<a href="#"
							class="rev-btn -md -danger"
							target="_blank">
							Go To Page
							<i class="fa fa-external-link"></i>
						</a>
						<button type="submit" 
								class="rev-btn -md -success">
							Save
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div role="tabpanel" class="-rev-tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-pills" role="tablist">
						<li role="presentation" class="active">
							<a href="#action-editor-tab" class="rev-btn -md -danger" aria-controls="home" role="tab" data-toggle="tab">Action</a>
						</li>
						<li role="presentation">
							<a href="#view-editor-tab" class="rev-btn -md -danger" aria-controls="tab" role="tab" data-toggle="tab">View</a>
						</li>
						<li role="presentation">
							<a href="#meta-editor-tab" class="rev-btn -md -danger" aria-controls="tab" role="tab" data-toggle="tab">
								Meta
							</a>
						</li>
						<li role="presentation">
							<a href="#wysiwyg-editor-tab" class="rev-btn -md -danger" aria-controls="tab" role="tab" data-toggle="tab">
								WYSIWYG
							</a>
						</li>
					</ul>
				
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel animated"
							transition="rev-show" 
							class="tab-pane active" 
							id="action-editor-tab">
							<div id="action-editor" class="_rev-editor-height"></div>
						</div>
						<div role="tabpanel animated"
							transition="rev-show" 
							class="tab-pane" 
							id="view-editor-tab">
							<div id="view-editor" class="_rev-editor-height"></div>
						</div>
						<div role="tabpanel animated"
							transition="rev-show" 
							class="tab-pane" 
							id="meta-editor-tab">
							<div class="row">
								<div class="col-sm-6">
									<div class="rev-field-group">
										<input type="text" 
												name="meta_title" 
												id="meta_title" 
												placeholder="Meta Title" 
												class="rev-field -lg _block"
												v-model="page.meta.title">
									</div>
									<div class="rev-field-group">
										<textarea name="meta_description" 
												id="meta_description" 
												cols="30" 
												rows="4" 
												placeholder="Meta Description" 
												class="rev-field -lg _block _height-auto"
												v-model="page.meta.description">
										</textarea>
									</div>
									<div class="rev-field-group">
										<textarea name="meta_keywords" 
												id="meta_keywords" 
												cols="30" 
												rows="4" 
												placeholder="Meta Keywords" 
												class="rev-field -lg _block _height-auto"
												v-model="page.meta.keywords">
										</textarea>
									</div>
								</div>
							</div>
						</div>
						<div role="tabpanel animated"
							transition="rev-show" 
							class="tab-pane" 
							id="wysiwyg-editor-tab">
							<!-- WYSIWYG Editor -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</template>
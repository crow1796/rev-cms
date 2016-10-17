<script>
	export default{
		created(){
			this.populateControllers();
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

			this.viewEditor = ace.edit("view-editor");
			this.viewEditor
					.setTheme("ace/theme/monokai");
			this.viewEditor.getSession().setUseWrapMode(true);
			this.viewEditor.getSession().setMode({
				path: "ace/mode/html",
				inline: true
			});
		},
		data(){
			return {
				baseUrl: base_url,
				controllers: [],
				actionEditor: null,
				viewEditor: null,
				page: {}
			}
		},
		methods: {
			savePage(){
				this.page.action = this.actionEditor.getValue();
				this.page.view = this.viewEditor.getValue();
				showRevLoader();
				this.$http
					.post("{admin_base_url}/api/revcms/pages/store", this.page)
					.then((response) => {
						console.log(response);
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
			}
		}
	}
</script>

<template>
	<form @submit.prevent="savePage()" action="">
		<div class="row" style="margin-top: 10px;">
			<div class="col-sm-6">
				<div class="rev-field-group">
					<input type="text" 
							name="page_title" 
							id="page_title" 
							placeholder="Page Title *" 
							class="rev-field -lg _block"
							v-model="page.title">
				</div>
				<div class="rev-field-group _relative text-left row">
					<div class="col-sm-2 _static"
						style="padding-left: 0;">
						<rev-controller-maker :controllers.sync="controllers"></rev-controller-maker>
					</div>
					<div class="col-sm-10"
						style="padding-right: 0;">
						<select class="rev-field -lg _block"
								name="controller" 
								id="controller"
								v-model="page.controller">
							<option selected>Select a Controller *</option>
							<option 
								value="{{ controller.name }}"
								v-for="controller in controllers">
								{{ controller.name }}
							</option>
						</select>
					</div>
				</div>
				<div class="rev-field-group">
					<input type="text" 
							name="action_name" 
							id="action_name" 
							placeholder="Action Name *" 
							class="rev-field -lg _block"
							v-model="page.action_name">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="rev-field-group">
					<input type="text" 
							name="page_slug" 
							id="page_slug" 
							placeholder="Page Slug ({{ baseUrl + '/' }})" 
							class="rev-field -lg _block"
							v-model="page.slug">
				</div>
				<div class="rev-field-group">
					<select class="rev-field -lg _block"
							name="template" 
							id="template"
							v-model="page.template">
						<option selected>Select Template</option>
						<option value="default">Default</option>
					</select>
				</div>
				<div class="rev-field-group text-right">
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
										<input type="text" name="meta_title" id="meta_title" placeholder="Meta Title" class="rev-field -lg _block">
									</div>
									<div class="rev-field-group">
										<textarea name="meta_description" id="meta_description" cols="30" rows="4" placeholder="Meta Description" class="rev-field -lg _block _height-auto"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</template>
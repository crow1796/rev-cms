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
				hideRevLoader();
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
	<form>
		<div class="row" style="margin-top: 10px;">
			<div class="col-sm-6">
				<div class="rev-field-group">
					<input type="text" name="page_title" id="page_title" placeholder="Page Title *" class="rev-field -lg _block">
				</div>
				<div class="rev-field-group _relative text-right">
					<span class="pull-left text-left">
						<rev-controller-maker :controllers.sync="controllers"></rev-controller-maker>
					</span>
					<select class="rev-field -lg"
							name="controller" 
							id="controller">
						<option selected>Select a Controller *</option>
						<option 
							value="{{ controller.name }}"
							v-for="controller in controllers">
							{{ controller.name }}
						</option>
					</select>
				</div>
				<div class="rev-field-group">
					<input type="text" name="action_name" id="action_name" placeholder="Action Name *" class="rev-field -lg _block">
				</div>
				<div class="rev-field-group">
					<input type="text" name="meta_title" id="meta_title" placeholder="Meta Title" class="rev-field -lg _block">
				</div>
				<div class="rev-field-group">
					<textarea name="meta_description" id="meta_description" cols="30" rows="4" placeholder="Meta Description" class="rev-field -lg _block _height-auto"></textarea>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="rev-field-group">
					<span class="rev-badge -lg -danger -flat" style="width: 140px;">
						{{ baseUrl + '/' }}
					</span>
					<input type="text" name="page_slug" id="page_slug" placeholder="Page Slug *" class="rev-field -lg" style="width: 72.5%"/>
				</div>
				<div class="rev-field-group">
					<input type="text" name="view_name" id="view_name" placeholder="View Name *" class="rev-field -lg _block">
				</div>
				<div class="rev-field-group">
					<div>
						<label for="hidden_page" style="margin: 0;">
							Hidden
						</label>
					</div>
					<label for="hidden_page">
						<input type="checkbox" 
								name="hidden_page" 
								id="hidden_page"
								class="rev-checkbox -danger _no-margin">
						Hidden pages are accessible only by logged-in back-end users.
					</label>
				</div>
				<div class="rev-field-group text-right">
					<a href="#"
						class="rev-btn -md -danger"
						target="_blank">
						Preview Page
						<i class="fa fa-external-link"></i>
					</a>
					<button type="button" 
							class="rev-btn -md -success"
							@click="savePage()">
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
					</div>
				</div>
			</div>
		</div>
	</form>
</template>
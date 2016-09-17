<script>
	export default{
		ready(){
			var actionEditor = ace.edit("action-editor");
			actionEditor
					.setTheme("ace/theme/monokai");
			actionEditor.getSession().setUseWrapMode(true);
			actionEditor.getSession().setMode({
				path: "ace/mode/php",
				inline: true
			});

			var viewEditor = ace.edit("view-editor");
			viewEditor
					.setTheme("ace/theme/monokai");
			viewEditor.getSession().setUseWrapMode(true);
			viewEditor.getSession().setMode({
				path: "ace/mode/php",
				inline: true
			});
		},
		data(){
			return {
				baseUrl: base_url
			}
		}
	}
</script>

<template>
	<div class="container-fluid">
		<form>
			<div class="row" style="margin-top: 10px;">
				<div class="col-sm-6">
					<div class="rev-field-group">
						<input type="text" name="page_title" id="page_title" placeholder="Page Title" class="rev-field -lg _block">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="rev-field-group">
						<span class="rev-badge -lg -danger" style="width: 140px;">
							{{ baseUrl + '/' }}
						</span>
						<input type="text" name="page_slug" id="page_slug" placeholder="Page Slug" class="rev-field -lg" style="width: 73%"/>
						<small class="error-message -danger">
							Slug already exists.
						</small>
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
							<div role="tabpanel" class="tab-pane active" id="action-editor-tab">
								<div id="action-editor" class="_rev-editor-height"></div>
							</div>
							<div role="tabpanel" class="tab-pane" id="view-editor-tab">
								<div id="view-editor" class="_rev-editor-height"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</template>
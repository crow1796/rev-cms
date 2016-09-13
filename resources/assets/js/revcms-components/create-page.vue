<script>
	export default{
		ready(){
			var actionEditor = ace.edit("action-editor");
			actionEditor
					.setTheme("ace/theme/monokai");
			actionEditor.getSession().setUseWrapMode(true);
			actionEditor.getSession().setMode("ace/mode/php");

			var viewEditor = ace.edit("view-editor");
			viewEditor
					.setTheme("ace/theme/monokai");
			viewEditor.getSession().setUseWrapMode(true);
			viewEditor.getSession().setMode("ace/mode/php");
		}
	}
</script>

<template>
	<div class="container-fluid">
		<h3 class="page-header">
			Add New Page
		</h3>

		<div class="row">
			<div class="col-sm-12">
				<h4>Action</h4>
				<div role="tabpanel" class="-rev-tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#action-editor-tab" aria-controls="home" role="tab" data-toggle="tab">Action</a>
						</li>
						<li role="presentation">
							<a href="#view-editor-tab" aria-controls="tab" role="tab" data-toggle="tab">View</a>
						</li>
					</ul>
				
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="action-editor-tab">
							<div id="action-editor">&lt;?php
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="view-editor-tab">
							<div id="view-editor">&lt;?php
							</div>
						</div>
					</div>
				</div>
				<div class="rev-tabpanel">
					<ul class="tabs">
						<li>
							<a href="#"></a>
						</li>
						<li>
							
						</li>
					</ul>
					<div class="contents">
						<div id="action-editor-tab" class="content">
							
						</div>
						<div id="view-editor-tab" class="content">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
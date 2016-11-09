<script type="text/javascript">
	export default {
		data() {
			return {
				viewType: 'grid',
				filter: {}
			};
		},
		methods: {
			toggleViewType(viewType){
				this.viewType = viewType;
			}
		},
		computed: {
			isGridView(){
				return this.viewType == 'grid';
			},
			isListView(){
				return this.viewType == 'list';
			}
		}
	}
</script>

<template>
	<div class="rev-grid"
			style="padding-bottom: 35px;">
		<!-- Library Nav -->
		<div class="view-nav">
			<button type="button" class="rev-btn -md -danger -has-icon-right">
				Upload
				<span class="icon">
					<i class="revicon-cloud-upload"></i>
				</span>
			</button>
			<button type="button" class="rev-btn -md -default -has-icon-right">
				Add Folder
				<span class="icon">
					<i class="revicon-folder-add"></i>
				</span>
			</button>
			<button type="button" class="rev-btn -md -default" title="Move">
				<i class="fa fa-reply-all"></i>
			</button>
			<button type="button" class="rev-btn -md -default" title="Delete">
				<i class="revicon-trash-can"></i>
			</button>
			<button class="rev-btn -md -default -has-icon-right">
				Reload
				<span class="icon">
					<i class="revicon-refresh"></i>
				</span>
			</button>
			<div class="right">
				<form class="search-form">
					<div class="rev-input-group">
						<input type="text" name="s" id="s" placeholder="Search a media here..." class="rev-field -md">
						<button type="submit" class="rev-btn -md -default">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</form>
				<div class="rev-input-group">
					<button type="button" 
							class="rev-btn -md -default grid" 
							:class="{ '-toggled': isGridView }" 
							@click="toggleViewType('grid')">
						<i class="fa fa-th"></i>
					</button>
					<button type="button" 
							class="rev-btn -md -default list" 
							:class="{ '-toggled': isListView }" 
							@click="toggleViewType('list')">
						<i class="fa fa-list"></i>
					</button>
				</div>
			</div>
		</div>
		<div class="view-nav">
			<select name="display" id="display" class="rev-field -md" v-model="filter.display">
				<option selected>Select Items to Display</option>
				<option value="all">All</option>
				<option value="images">Images</option>
				<option value="video">Video</option>
				<option value="audio">Audio</option>
				<option value="documents">Documents</option>
			</select>
			<select name="" id="" class="rev-field -md" v-model="filter.orderby">
				<option selected>Order by</option>
				<option value="filename">Filename</option>
				<option value="size">Size</option>
				<option value="last_updated">Last Updated</option>
			</select>
		</div>
		<!-- /Library Nav -->
		<!-- Library -->
		<rev-media-items
			:viewtype.sync="viewType">
		</rev-media-items>
		<!-- /Library -->
	</div>
</template>
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
	<div class="rev-grid _full-height"
			style="padding-bottom: 35px;">
		<!-- Library Nav -->
		<div class="view-nav">
			<div class="rev-input-group">
				<button type="button" class="rev-btn -md -primary">
					<i class="fa fa-upload"></i>
					Upload
				</button>
				<button type="button" class="rev-btn -md -primary">
					<i class="fa fa-folder"></i>
					Add Folder
				</button>
				<button type="button" class="rev-btn -md -warning">
					<i class="fa fa-reply-all"></i>
				</button>
				<button type="button" class="rev-btn -md -danger" title="Delete">
					<i class="fa fa-trash"></i>
				</button>
				<button class="rev-btn -md -default">
					<i class="fa fa-refresh"></i>
				</button>
			</div>
			<div class="right">
				<form class="search-form">
					<div class="rev-input-group">
						<input type="text" name="s" id="s" placeholder="Search a media here..." class="rev-field -md">
						<button type="submit" class="rev-btn -md -primary">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</form>
				<div class="rev-input-group">
					<button type="button" 
							class="rev-btn -md -primary grid" 
							:class="{ '-toggled': isGridView }" 
							@click="toggleViewType('grid')">
						<i class="fa fa-th"></i>
					</button>
					<button type="button" 
							class="rev-btn -md -primary list" 
							:class="{ '-toggled': isListView }" 
							@click="toggleViewType('list')">
						<i class="fa fa-list"></i>
					</button>
				</div>
			</div>
		</div>
		<div class="view-nav">
			<div class="rev-input-group">
				<select name="display" id="display" class="rev-btn -md -primary" v-model="filter.display">
					<option selected>Select Items to Display</option>
					<option value="all">All</option>
					<option value="images">Images</option>
					<option value="video">Video</option>
					<option value="audio">Audio</option>
					<option value="documents">Documents</option>
				</select>
				<select name="" id="" class="rev-btn -md -primary" v-model="filter.orderby">
					<option selected>Order by</option>
					<option value="filename">Filename</option>
					<option value="size">Size</option>
					<option value="last_updated">Last Updated</option>
				</select>
			</div>
		</div>
		<!-- /Library Nav -->
		<!-- Library -->
		<rev-media-items
			:viewtype.sync="viewType">
		</rev-media-items>
		<!-- /Library -->
	</div>
</template>
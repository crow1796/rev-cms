<script type="text/javascript">
	export default{
		created() {
			// Get all pages.
			this.getAllPages();
		},
		data() {
			return {
				adminBaseUrl: admin_base_url,
				baseUrl: base_url,
				pages: [],
				viewType: 'grid',
				selectionMode: false,
				selections: []
			};
		},
		methods: {
			toggleViewType(type){
				this.$set('viewType', type);
			},
			toggleSelectionMode(){
				this.selections = [];
				this.selectionMode = !this.selectionMode;
				for(var i = 0; i < this.pages.length; i++){
					this.pages[i].selected = false;
				}
			},
			toggleSelected(page){
				if(!this.selectionMode) return false;
				page = _.merge(page, {
					selected: page.selected ? !page.selected : true
				});
				this.pages.$set(this.pages.indexOf(page), page);

				if(page.selected){
					this.selections.push(page);
					return true;
				}

				this.selections.$remove(page);
			},
			deletePage(page){
				this.sweetConfirm(function(){
					this.pages.$remove(page);
					swal(
						'Deleted',
						'Your page(s) has been deleted successfully!',
						'success');
				}.bind(this), function(dismiss){
					swal(
						'Cancelled',
						'Your page is safe!',
						'error');
				}.bind(this));
			},
			deleteSelectedItems(){
				this.sweetConfirm(function(){
					this.pages = _.difference(this.pages, this.selections);
					swal(
						'Deleted',
						'Your page(s) has been deleted successfully!',
						'success');
				}.bind(this), 
				function(dismiss){
					swal(
						'Cancelled',
						'Your page is safe!',
						'error');
				}.bind(this));
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
			getAllPages(){
				this.$http
					.get("{admin_base_url}/api/revcms/pages/all-pages")
					.then((response) => {
						this.pages = response.data;
						hideRevLoader();
					});
			}
		},
		computed: {
			isGridView: function() {
				return this.viewType == 'grid';
			},
			isListView: function() {
				return this.viewType == 'list';
			}
		}
	}
</script>

<template>
	<div class="rev-grid">
		<!-- Page Nav -->
		<div class="view-nav">
			<a href="{{ adminBaseUrl }}/pages/create" class="rev-btn -md -danger -has-icon-right">
				Add New
				<span class="icon">
					<i class="revicon-bookmark-add"></i>
				</span>
			</a>
			<button class="rev-btn -md -default -has-icon-right" 
					@click="toggleSelectionMode"
					:class="{ '-toggled': selectionMode }"
					v-if="pages.length">
						Selection Mode:
						<span v-if="selectionMode">On</span>
						<span v-else="!selectionModel">Off</span>
					<span class="icon">
						<i class="revicon-tag-checked"></i>
					</span>
			</button>
			<button class="rev-btn -md -danger" 
					v-if="selectionMode && selections.length" 
					title="Delete Selected Items"
					@click="deleteSelectedItems()">
				<i class="fa fa-trash"></i>
			</button>
			<div class="right">
				<form class="search-form">
					<div class="rev-input-group">
						<input type="text" name="s" id="s" placeholder="Search a page here..." class="rev-field -md">
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
		<!-- Page Nav -->
		<div class="row" v-if="!pages.length">
			<h2 class="text-center">
				You have no Page(s). 
				<a href="/admin/pages/create" class="rev-btn -md -danger _v-middle -has-icon-right">
					Add New
				<span class="icon">
					<i class="revicon-bookmark-add"></i>
				</span>
				</a>
			</h2>
		</div>
		<div class="row grid-view"
				v-if="viewType == 'grid'"
				v-for="pagerow in pages | chunk 4">
			<div class="grid-item col-sm-3"  
				v-for="page in pagerow"
				:class="{ '-selected': page.selected, '-selection-mode': selectionMode }" 
				@click="toggleSelected(page)">
				<div class="preview">
					<span class="revicon-picture"></span>
				</div>
				<table class="info">
					<tbody>
						<tr class="title">
							<td>
								<strong>Title:</strong>
							</td>
							<td>
								{{ page.title }}
							</td>
						</tr>
						<tr class="url">
							<td>
								<strong>URL:</strong>
							</td>
							<td>
								<a href="{{ baseUrl + '/' +  page.url.replace('/', '') }}" 
									target="_blank"
									class="_block">
									{{ page.url }}
									<span class="pull-right"><i class="revicon-link"></i></span>
								</a>
							</td>
						</tr>
						<tr class="controller">
							<td>
								<strong>Controller:</strong>
							</td>
							<td title="{{ page.controller }}">
								{{ page.controller }}
							</td>
						</tr>
						<tr class="action">
							<td>
								<strong>Action:</strong>
							</td>
							<td>
								{{ page.action }}
							</td>
						</tr>
						<tr v-show="!selectionMode">
							<td colspan="2" class="text-center">
								<a href="#" class="rev-btn -sm -default -has-icon-right" title="Edit the Page">
									Edit
									<span class="icon">
										<i class="revicon-document-edit"></i>
									</span>
								</a>
								<button type="button" 
										class="rev-btn -sm -default -has-icon-right"
										title="Delete the Page"
										@click="deletePage(page)">
									Delete
									<span class="icon">
										<i class="revicon-trash-can"></i>
									</span>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>
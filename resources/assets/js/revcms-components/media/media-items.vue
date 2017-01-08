<script type="text/javascript">
	export default{
		props: {
			viewtype: {
				default: 'grid'
			}
		},
		data(){
			return {
				medias: [
					{
						uid: 1,
						filename: 'image123.png',
						size: 1300,
						url: '/storage/app/media/image123.jpg',
						last_modified: 'Sept 12, 2016'
					}
				],
				selectedMedia: {}
			};
		},
		methods: {
			toggleSelected(media){
				this.medias = _.map(this.medias, function(media){
					media.selected = false;
					return media;
				});
				media = _.merge(media, {
					selected: true
				});
				this.medias.$set(this.medias.indexOf(media), media);
				this.$set('selectedMedia', media);
			}
		}
	}
</script>

<template>
	<div class="row _clearfix"
			style="padding-bottom: 35px;">
		<!-- Items -->
		<div class="col-sm-8"
			v-if="viewtype == 'grid'"
			style="padding-bottom: 35px;">
			<div class="row grid-view"
					v-for="mediarow in medias | chunk 3">
				<div class="grid-item col-xs-4 _pointer"
					:class="{ '-selected _animation-once': media.selected }"
					v-for="media in mediarow"
					track-by="$index"
					@click="toggleSelected(media)">
					<div class="preview">
						
					</div>
					<table class="info">
						<tbody>
							<tr>
								<td>
									<strong>
										Title:
									</strong>
								</td>
								<td>
									{{ media.filename }}
								</td>
							</tr>
							<tr>
								<td>
									<strong>
										Size:
									</strong>
								</td>
								<td>
									{{ media.size /1000 }} KB
								</td>
							</tr>
							<tr></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /Items -->
		<!-- Preview -->
		<div class="col-sm-4">
			<div class="grid-view row">
				<div class="grid-item col-sm-12"
						v-if="selectedMedia != {}">
					<div class="preview -lg">
						
					</div>
					<table class="info">
						<tbody>
							<tr>
								<td>
									<strong>
										Title:
									</strong>
								</td>
								<td>
									{{ selectedMedia.filename }}
								</td>
							</tr>
							<tr>
								<td>
									<strong>
										Size:
									</strong>
								</td>
								<td>
									{{ selectedMedia.size /1000 }} KB
								</td>
							</tr>
							<tr>
								<td>
									<strong>
										URL:
									</strong>
								</td>
								<td>
									<a href="{{ selectedMedia.url }}" target="_blank">
										{{ selectedMedia.url }}
									</a>
								</td>
							</tr>
							<tr>
								<td>
									<strong>
										Last Modified:
									</strong>
								</td>
								<td>
									{{ selectedMedia.last_modified }}
								</td>
							</tr>
							<tr></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /Preview -->
	</div>
</template>
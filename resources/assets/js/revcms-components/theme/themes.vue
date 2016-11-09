<script type="text/javascript">
	export default{
		created(){
			showRevLoader();
			this.$http.get("{base_url}/api/revcms/themes/installed-themes")
				.then((response) => {
					this.themes = response.data;
					hideRevLoader();
				});
		},
		data(){
			return {
				themes: []
			};
		},
		methods: {
			themes: []
		},
		computed: {

		}
	}
</script>

<template>
	<div class="view-nav">
		<button class="rev-btn -md -danger -has-icon-right" type="button">
			Add New
			<span class="icon">
				<i class="revicon-layout4"></i>
			</span>
		</button>
	</div>
	<div class="rev-grid">
		<div class="row grid-view _row-eq-height"
				v-for="themeRow in themes | chunk 3">
			<div class="col-sm-4 grid-item _word-wrap"
					v-for="theme in themeRow">
				<rev-theme-card :theme.sync="theme" :themes.sync="themes"></rev-theme-card>
			</div>
		</div>
	</div>
</template>
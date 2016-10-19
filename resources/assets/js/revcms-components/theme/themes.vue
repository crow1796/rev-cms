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
	<h2>Installed Themes</h2>
	<div class="view-nav">
		<button class="rev-btn -md -danger" type="button">
			Add New
		</button>
	</div>
	<div class="rev-grid">
		<div class="row grid-view _row-eq-height"
				v-for="themeRow in themes | chunk 3">
			<div class="col-sm-4 grid-item _word-wrap"
					v-for="theme in themeRow">
				<rev-theme-card :theme.sync="theme"></rev-theme-card>
			</div>
		</div>
	</div>
</template>
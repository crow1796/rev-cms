<script type="text/javascript">
	export default{
		props: ['theme', 'themes'],
		computed: {
			themeScreenshot(){
				return this.theme.info.screenshot ? this.theme.info.screenshot : '';
			}
		},
		methods: {
			activateTheme(theme){
				console.log(theme);
				showRevLoader();
				this.$http
					.post('{admin_base_url}/api/revcms/themes/activate-theme', theme)
					.then(function(response){
						let responseData = response.data;

						if(responseData.status == 'failed'){
							swal(
								'Activation Failed!',
								responseData.messages[0],
								'error'
								)
							return false;
						}

						for(let counter = 0; counter < this.themes.length; counter++){
							this.$set("themes[" + counter + "].active", false);
						}

						this.$set('theme.active', true);
						// theme.$set('active', true);

						hideRevLoader();
						swal(
							'Theme Activated!',
							'Theme has been successfully activated.',
							'success'
							)
					}.bind(this))
			}
		}
	}
</script>

<style type="text/css">
	.active-theme{
		position: absolute;
		width: 93%;
		height: 100%;
		text-align: center;
		font-size: 4em;
		font-weight: bold;
		line-height: 400px;
	}

	.active-theme > span{
		border-radius: 50%;
		width: 250px;
		height: 250px;
		display: inline-block;
		line-height: 250px;
	}

	.theme-controls{
		min-height: 30px;
	}
</style>

<template>
	<div class="active-theme"
		v-if="theme.active">
		<span>Active</span>
	</div>
	<div class="preview -lg" 
		:style="{ 'background-image': 'url(' + themeScreenshot + ')' }">
	</div>
	<button type="button" 
			class="rev-btn -md -danger theme-activate-btn"
			@click="activateTheme(theme)"
			v-if="!theme.active"
			title="Activate">
		<i class="revicon-switch"></i>
	</button>
	<button type="button" 
			class="rev-btn -md -default theme-delete-btn"
			v-if="!theme.active"
			title="Delete">
		<i class="revicon-trash-can"></i>
	</button>
	<div class="info">
		<h3 class="text-center _no-margin">
			{{ theme.info.name }}
		</h3>
		<p>
			<div>
				<h5 class="_no-margin">Description:</h5>
				<div style="padding: 4px 0;">
					{{ theme.info.description }}
				</div>
			</div>
			<div>
				<h5 class="_no-margin">URL:</h5>
				<div style="padding: 4px 0;">
					{{ theme.info.url }}
				</div>
			</div>
			<div>
				<h5 class="_no-margin">Author:</h5>
				<div style="padding: 4px 0;">
					{{ theme.info.author }}
				</div>
			</div>
		</p>
		<!-- <div class="text-center theme-controls">
			<div class="rev-input-group">
				<button type="button" 
						class="rev-btn -md -success"
						@click="activateTheme(theme)"
						v-if="!theme.active">
					<i class="fa fa-check-circle"></i>
					Activate
				</button>
				<button type="button" 
						class="rev-btn -md -danger"
						v-if="!theme.active">
					Delete
					<i class="fa fa-times-circle"></i>
				</button>
			</div>
		</div> -->
	</div>
</template>
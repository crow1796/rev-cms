<script type="text/javascript">
	export default{
		props: ['theme'],
		computed: {
			themeScreenshot(){
				return this.theme.info.screenshot ? this.theme.info.screenshot : '';
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
</style>

<template>
	<div class="active-theme"
		v-if="theme.active">
		<span>Active</span>
	</div>
	<div class="preview -lg" 
		:style="{ 'background-image': 'url(' + themeScreenshot + ')' }">
	</div>
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
		<div class="text-center"
				v-if="!theme.active">
			<button type="button" class="rev-btn -md -success">
				Activate
			</button>
			<button type="button" class="rev-btn -md -danger">
				Delete
			</button>
		</div>
	</div>
</template>
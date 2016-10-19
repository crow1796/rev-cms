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

<template>
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
		<div class="text-center">
			<button type="button" class="rev-btn -md -success">
				Activate
			</button>
			<button type="button" class="rev-btn -md -danger">
				Delete
			</button>
		</div>
	</div>
</template>
<script type="text/javascript">
	export default{
		props: ['theme']
	}
</script>

<template>
	<div class="preview -lg" style="background-image: {{ theme.info.screenshot }};">
	</div>
	<div class="info">
		<h3 class="text-center _no-margin">
			{{ theme.info.name }}
		</h3>
		<p>
			<div>
				<h5 class="_no-margin">Description:</h5>
				<div style="padding: 4px 4px 4px 20px;">
					{{ theme.info.description }}
				</div>
			</div>
			<div>
				<h5 class="_no-margin">URL:</h5>
				<div style="padding: 4px 4px 4px 20px;">
					{{ theme.info.url }}
				</div>
			</div>
			<div>
				<h5 class="_no-margin">Author:</h5>
				<div style="padding: 4px 4px 4px 20px;">
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
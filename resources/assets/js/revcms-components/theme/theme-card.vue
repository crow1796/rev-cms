<script type="text/javascript">
	export default{
		props: ['theme']
	}
</script>

<template>
	<div class="preview -lg" style="background-image: {{ theme.info.screenshot }};">
	</div>
	<div class="info">
		{{ theme.info.name }}
		{{ theme.info.description }}
		{{ theme.info.url }}
		{{ theme.info.author }}
		{{ theme.path }}
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
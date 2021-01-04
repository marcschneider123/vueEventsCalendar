<template>
	<social-sharing :url="url"
		title="Kommt zusammen!"
		quote="Kommt zusammen!"
		description="Lorem ipsum dolor sit amet, consectetur adipisicing elit. A corporis eveniet quod rem unde. At cupiditate eos eveniet nesciunt voluptas?"
		media="https://github.com/marcschneider123/assets/images/cta/cta.jpg"
		inline-template
	>
		<span class="social-sharing">
			<network network="facebook">
				<i class="fab fa-facebook"></i>Auf Facebook teilen
			</network>
		</span>
	</social-sharing>
</template>

<script>
	import socialSharing from 'vue-social-sharing'
	export default {
		props:['url'],
		components:{
			socialSharing
		}
	}
</script>

<style lang="scss">
	.social-sharing span {
		display: inline-block;
		text-transform: uppercase;
		text-decoration: underline;

		&:hover {
			cursor: pointer;
		}
	}
</style>
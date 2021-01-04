<template>
	<div>
		<img src="/assets/images/map.jpg" usemap="#image-map" class="img-fluid">
		<map name="image-map">
			<area v-for="(coord, label) in locations" :alt="label" :title="label" @click="updateLocation(label)" :coords="coord" shape="rect">
			<!--<area target="_blank" alt="München" title="München" href="/events/Event_Munchen" coords="290,472,46" shape="circle">-->
		</map>
	</div>
</template>
<script>
	import imResizer from 'image-map-resizer'

	export default {
		mounted(){
			imResizer()
		},
		props:[
			'locations'
		],
		data(){
			return {
				//
			}
		},
		computed: {
			//
		},
		methods:{
			updateLocation(location){
				return this.$emit('changed', location)
			}
		},
		components: {
			//
		}
	};
</script>

<style lang="scss">

</style>
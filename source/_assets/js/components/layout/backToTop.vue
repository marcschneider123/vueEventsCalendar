<template>
	<a v-show="scrolled" href="#" class="back-to-top" v-scroll-to="'#page-top'"><i class="fas fa-angle-up"></i></a>
</template>
<script>
	export default {
		data () {
			return {
				scrolled: false
			};
		},
		methods: {
			handleScroll () {
				this.scrolled = window.scrollY > 100;
			}
		},
		created () {
			window.addEventListener('scroll', this.handleScroll);
		},
		destroyed () {
			window.removeEventListener('scroll', this.handleScroll);
		}
	};
</script>

<style lang="scss">

</style>
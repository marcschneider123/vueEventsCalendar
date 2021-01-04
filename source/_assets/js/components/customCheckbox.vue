<template>
	<label class="custom-checkbox" v-if="(url || scroll)" >
		<a v-if="scroll" href="#" v-scroll-to="scroll">
			<div class="label" :style="'height: ' + height">
				<img v-if="bgImg" :src="'/assets/images/' + bgImg" class="img-fluid" v-bind:class="{'d-none d-lg-block' : bgImgMobile}">
				<img v-if="bgImgMobile" :src="'/assets/images/' + bgImgMobile" class="img-fluid d-block d-lg-none">
				<div class="overlay">
					<div class="title">
						<slot></slot>
					</div>
				</div>
				<div v-if="hasHoverSlot" class="overlay-hover">
					<slot name="hover"></slot>
				</div>
				<div v-else class="overlay-hover">
					<div class="title">
						<slot></slot>
					</div>
				</div>
			</div>
		</a>
		<a v-else-if="url" :href="url" :title="'Gehe zu ' + url">
			<div class="label" :style="'height: ' + height">
				<img v-if="bgImg" :src="'/assets/images/' + bgImg" class="img-fluid" v-bind:class="{'d-none d-lg-block' : bgImgMobile}">
				<img v-if="bgImgMobile" :src="'/assets/images/' + bgImgMobile" class="img-fluid d-block d-lg-none">
				<div class="overlay">
					<div class="title">
						<slot></slot>
					</div>
				</div>
				<div v-if="hasHoverSlot" class="overlay-hover">
					<slot name="hover"></slot>
				</div>
				<div v-else class="overlay-hover">
					<div class="title">
						<slot></slot>
					</div>
				</div>
			</div>
		</a>
	</label>
	<label class="custom-checkbox" v-else>
		<input type="checkbox" v-model="checked" :value="val" @change="onChange">
		<div class="label" :style="'height: ' + height">
			<img v-if="bgImg" :src="'/assets/images/' + bgImg" class="img-fluid">
			<div class="overlay">
				<div class="title">
					<slot></slot>
				</div>
			</div>
			<div v-if="hasHoverSlot" class="overlay-hover">
				<slot name="hover"></slot>
			</div>
			<div v-else class="overlay-hover">
				<div class="title">
					<slot></slot>
				</div>
			</div>
		</div>
	</label>
</template>

<script>
	/**
	 * custom checkbox: usable as link or checkbox
	 * @param	bg-img
	 * @param	link
	 * @param	type cb | link
	 * @example 	<custom-checkbox type="cb"
	 				bg-img="cta/cta.jpg"
	 	 				link="http://google.com"
	 	 			>
	 					Kommt Zusammen link (default)
	 						<span slot="hover">
	 						hover-slot
	 					</span>
	 	 			</custom-checkbox>
	 */
	export default {
		props: [
			'bgImg',
			'bgImgMobile',
			'height',
			'val',
			'value',
			'scroll',
			'url'
		],
		computed: {
			checked: {
				get () {
					return this.value
				},
				set (val) {
					this.checkedProxy = val
				}
			},
			hasHoverSlot(){
				return !!this.$slots['hover']
			}
		},
		data() {
			return {
				checkedProxy: false
			}
		},
		methods:{
			onChange: function(e) {
				this.$emit('input', this.checkedProxy)
			}
		}
	}
</script>

<style lang="scss">
	.custom-checkbox{

		height: 100%;
		width: 100%;

		a:hover{
			text-decoration: none;
		}

		/* Hide the browser's default checkbox */
		input {
			position: absolute;
			opacity: 0;
		}

		.overlay {
			height: 100%;
			width: 100%;
			position: absolute;
			top: 0;
			padding: 15px;
			align-items: center;
			justify-content: center;
			display: flex;
			flex-direction: column;
		}

		.overlay-hover {
			@extend .overlay;
			display: none;
		}
		.title{
			//
		}

		.label{
			position: relative;
			height: 100%;
			width: 100%;
			cursor: pointer;
			text-align: center;
		}

		/* checkbox is checked */
		input:checked ~ .label, .label:hover {
			//border: $input-border-size solid $input-border-color-checked;
		}

		/* When the checkbox is checked and hovered, remove blue border */
		//input:checked ~ .label:hover {
		//	border: $input-border-size solid $input-border-color;
		//}
	}

	//hover
	.custom-checkbox:hover {
		.overlay{
			display: none;
		}

		.overlay-hover{
			display: flex;
		}
	}
</style>
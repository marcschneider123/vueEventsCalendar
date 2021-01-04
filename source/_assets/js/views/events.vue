<template>
	<div v-if="errored">
		<b-alert variant="danger" :show="errored">
			Fehler beim Laden der Daten!
		</b-alert>
	</div>
	<div v-else>
		<div v-if="loading">
			<b-alert :show="loading" class="text-center">Lade Veranstaltungen <i class="fas fa-circle-notch fa-spin"></i></b-alert>
		</div>
		<div v-else>
			<b-row no-gutters>
				<div class="col-lg-4 overflow-hidden pb-2 pb-lg-0">
					<custom-checkbox
							bg-img="cta/cta.jpg"
							bg-img-mobile="cta/cta_mobile.jpg"
							scroll="#eventsTable"
							class="mb-0"
					>
						Kommt zusammen!
					</custom-checkbox>
					<b-card title="Nächste Veranstaltung:" class="card-large mt-1">
						<b-card-sub-title>
							{{nextEvent.city}}
							<br>
							{{nextEvent.date | moment("Do MMMM YYYY")}}
							<b-button variant="link" v-b-toggle.nextEvent_details class="d-md-none float-right"><i class="fas fa-2x fa-angle-up opened"></i><i class="fas fa-2x fa-angle-down closed"></i></b-button>
						</b-card-sub-title>

						<b-collapse id="nextEvent_details" class="d-md-none">
							<b-card-text>
								<i class="fas fa-clock"></i>{{nextEvent.date | moment("HH:mm")}} Uhr
							</b-card-text>
							<b-card-text>
								<i class="fas fa-map-marker-alt"></i>{{nextEvent.location}}
							</b-card-text>
							<div class="pt-xl-3 ml-3">
								<p class="pb-0 pb-xl-3">
									<a href="" @click.prevent="updateLocation(nextEvent.city)" title="Mehr erfahren" class="text-uppercase text-danger">
										<strong>Mehr erfahren</strong>
									</a>
								</p>
								<p>
									<a :href="'/assets/calendar/' + nextEvent.city + '.ics'" title="Zum Kalender hinzufügen" class="text-uppercase">
										<i class="fas fa-calendar"></i>Zum Kalender hinzufügen
									</a>
								</p>
								<p>
									<social-share :url="nextEvent.url"></social-share>
								</p>
							</div>
						</b-collapse>
						<div class="d-none d-md-block">
							<b-card-text>
								<i class="fas fa-clock"></i>{{nextEvent.date | moment("HH:mm")}} Uhr
							</b-card-text>
							<b-card-text>
								<i class="fas fa-map-marker-alt"></i>{{nextEvent.location}}
							</b-card-text>
							<div class="pt-xl-3 ml-3">
								<p class="pb-0 pb-xl-3">
									<a href="" @click.prevent="updateLocation(nextEvent.city)" title="Mehr erfahren" class="text-uppercase text-danger">
										<strong>Mehr erfahren</strong>
									</a>
								</p>
								<p>
									<a :href="'/assets/data/calendar/' + nextEvent.city + '.ics'" title="Zum Kalender hinzufügen" class="text-uppercase">
										<i class="fas fa-calendar"></i>Zum Kalender hinzufügen
									</a>
								</p>
								<p>
									<social-share :url="nextEvent.url"></social-share>
								</p>
							</div>
						</div>
					</b-card>
				</div>
				<div class="col-lg-8">
					<img-map :locations=locations @changed="updateLocation"></img-map>
				</div>
			</b-row>
			<b-row no-gutters class="">
				<div class="col-12">
					<b-card bg-variant="danger">
						<b-row align-v="center">
							<div class="col-md-6">
								<b-card-title>
									Finde eine Veranstaltung in deiner Nähe:
								</b-card-title>
							</div>
							<div class="col-md-6">
								<b-card-text>
									<b-input-group class="mt-4 mt-md-0">
										<b-input-group-text slot="append"><i class="fas fa-search"></i></b-input-group-text>
										<b-form-input v-model="filter" type="search" placeholder="Bitte Ort/PLZ eingeben" />
	<!--									<b-input-group-append>-->
	<!--										<b-button :disabled="!filter" @click="filter = ''"><i class="fas fa-times m-0"></i></b-button>-->
	<!--									</b-input-group-append>-->
									</b-input-group>
								</b-card-text>
							</div>
						</b-row>
					</b-card>
				</div>
			</b-row>

	<b-row no-gutters>
				<div class="col-12">
					<b-table
						id="eventsTable"
						class="bg-light"
						:items="events"
						:fields="fields"
						:filter="filter"
						:filter-function="filterCity"
						show-empty
						thead-class="d-none"
						@row-clicked="toggleExpand"
						@filtered="onFiltered"
					>
						<template v-slot:cell(date_day)="data">
							<i class="fas fa-calendar"></i>
							<span class="d-none d-md-inline-block">{{data.item.date | moment("dddd, Do MMMM YYYY")}}</span>
							<span class="d-inline-block d-md-none">{{data.item.date | moment("DD.MM.YY")}}</span>
						</template>
						<template v-slot:cell(date_time)="data">
							<i class="fas fa-clock"></i>{{data.item.date | moment("HH:mm")}} Uhr
						</template>
						<template v-slot:cell(location)="data">
							<i class="fas fa-map-marker-alt"></i>{{data.item.location}}
						</template>

						<!--					Details button-->
						<template v-slot:cell(show_details)="row">
							<b-button variant="link" block @click="row.toggleDetails" class="p-0">
								<span v-show="row.detailsShowing"><i class="fas fa-angle-up"></i></span>
								<span v-show="!row.detailsShowing"><i class="fas fa-angle-down"></i></span>
							</b-button>
						</template>
						<!--					Details row-->
						<template v-slot:row-details="row">
							<p class="d-lg-none">
								<span class="d-block d-md-inline-block mb-3 mb-md-0"><i class="fas fa-clock"></i>{{row.item.date | moment("HH:mm")}} Uhr</span>
								<span class="d-block d-md-inline-block ml-md-5"><i class="fas fa-map-marker-alt"></i>{{row.item.location}}</span>
							</p>
							<p v-html="row.item.desc"></p>
							<p>
								<a :href="'/assets/data/calendar/' + row.item.city + '.ics'" title="Zum Kalender hinzufügen" class="text-uppercase mr-5">
									<i class="fas fa-calendar"></i>Zum Kalender hinzufügen
								</a>
								</p><p>
								<social-share :url="row.item.url"></social-share>
							</p>
						</template>
						<template slot="emptyfiltered" slot-scope="scope" class="text">
							<h4 class="text-center">Bitte versuche es mit einem anderen Ort.</h4>
						</template>
					</b-table>
				</div>
			</b-row>
		</div>
	</div>
</template>
<script>
	import 'url-search-params-polyfill';
	import moment from 'moment'
	import papa from 'papaparse'
	import imgMap from '../components/imageMap'
	import socialShare from '../components/socialShare'
	import customCheckbox from '../components/customCheckbox'

	export default {
		created(){
			axios
				.get('/assets/data/events.json')
				.then(response => {
					this.events = response.data
					// console.log(this.eventsJson);
				})
				.catch(error => {
					console.error(error)
					this.errored = true
				})
				.finally(() => {
					//sort event data before vs-table is mounted
					this.sortEvents()
					this.loading = false
				})
		},
		mounted(){
			//search after table is initialized and event is submitted
			if (this.urlEvent){
				//scroll when dom is fully loaded (next.tick not working!?)
				window.addEventListener('load', () => {
					this.updateLocation(this.urlEvent)
				})
			}
		},
		data(){
			return {
				loading: true,
				errored: false,
				events: [],
				nextEvent: [],
				locations: {},
				fields: [
					{
						key: 'city',
						label: 'Stadt',
						class: 'font-weight-bold'
					},
					{
						key: 'date_day',
						label: 'Tag',
					},
					{
						key: 'date_time',
						label: 'Zeit',
						class : 'd-none d-md-table-cell'
					},
					{
						key: 'location',
						label: 'Ort',
						class: 'd-none d-lg-table-cell'
					},
					{
						key: 'show_details',
						label: ''
					}
				],
				filter: null
			}
		},
		computed: {
			/**
			 * get event from URL parameter
			 * @example ?event=Aaachen
			 */
			urlEvent: function(){
				const urlParams = new URLSearchParams(window.location.search);
				return urlParams.get('event');
			}
		},
		methods:{
			/**
			 * update b-table filter with selected location via urlParam, imagemap or more info link
			 */
			updateLocation(val){
				this.filter = val
				VueScrollTo.scrollTo('#eventsTable')
			},

			//expand details on row click
			toggleExpand(item, toggle){
				if (toggle == 'open') {
					this.$set(item, '_showDetails', true)
				} else if (toggle == 'close') {
					this.$set(item, '_showDetails', false)
				} else {
					this.$set(item, '_showDetails', !item._showDetails)
				}
			},

			/**
			 * filter by city name, if zip with 5 decimals is submitted parse the csv list to search for nearest event city
			 */
			filterCity(val) {
				let x = this.filter
				let zipLength = (Math.log10((x ^ (x >> 31)) - (x >> 31)) | 0) + 1

				if (Number.isInteger(Number(x)) && zipLength == 5 ) {
					this.parseCsv(x)
				}

				return !this.filter || val['city'].toLowerCase().includes(this.filter.toLowerCase())
			},

				//b-table filtered callback
			onFiltered(filteredItems) {
				if (filteredItems.length == 1) {
					this.toggleExpand(filteredItems[0], 'open')
				}
			},

			/**
			 * sort events by next first in asc order, past events at bottom in desc order
			 */
			sortEvents(){
				let nextIdx = null

				_.forEach(this.events, (event, key) => {
					//find next event
					if (moment(event.date) >= moment()) {
						if(nextIdx === null){
							nextIdx = key
							this.nextEvent = event
						}
					} else {
						event['_rowVariant'] = 'dark'
					}

					//save imagemap locations
					this.locations[event.city] = event.imap
				})

				//concat slice future - past events
				if (nextIdx !== null) {
					this.events = _.concat(_.slice(this.events, nextIdx), _.slice(this.events, 0, nextIdx).reverse())
				}
			},

			/**
			 * List of zips with corresponding event cities to find closest event near your location
			 * Parse csv list until zip is found or parsed zip > zip to match events to surrounding cities
			 * @param zip
			 */
			parseCsv(zip) {
				let row, row_prev = [];
				const that = this

				papa.parse("/assets/data/zips.csv", {
					download: true,
					delimiter: ',',
					header: true,
					trimHeaders: true,
					// quoteChar: '"',
					skipEmptyLines: true,

					step: function (results, parser) {
						row = results.data;
						//check for wrong csv formatting
						if( (typeof row.zip == 'undefined') || (row.zip.length != 5)) {
							console.error("Invalid CSV! Please check formating!");
							row = [];
							parser.abort();
						}

						if (row.zip == zip) {
							parser.abort();
						}

						// check if prev or current zip is closer
						else if (row.zip >= zip){
							if((zip - row_prev.zip) < (row.zip - zip) ){
								row = row_prev;
							}
							parser.abort();
						}
						row_prev = row;
						that.filter = row.event
					},
					error: function (error, file) {
						console.warn(error, file);
					}
				});
			}
		},
		components: {
			imgMap,
			customCheckbox,
			papa,
			socialShare
		}
	};
</script>

<style lang="scss">

</style>
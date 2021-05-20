<template>
<div>
  <H1>Search for places</H1>

  <div>
      <input type="text" v-model="location" ref="location" @keyup="autocompleteSearch" placeholder="Type location...">
  </div>
  <div>
     <!-- <button @click="searchPlaces">Search</button> -->
  </div>
  
  <!-- <p>Lat = {{lat}} Lon ={{lon}}</p>
	<p>{{error}}</p> -->
	<!-- <button @click="myFunction()">Click Me</button> --> 
	<!-- <button @click="displayLocation">Click Me</button>   -->

</div>
</template>

<script>
export default {
  data(){
    return{
      error: '',
      lat:'24.312517399999997',
      lon:'91.7275835',
      location:'',
    }
  },
  methods:{ 
    async  getAddress () {		
        // var url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='+this.lat+','+this.lon+'&sensor=true';
        var url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' + this.lat + ',' + this.lon + '&sensor=true';
        try{
          let {data} =await  axios({
              method: 'get',
              url:url
          })
          console.log(data); 

        }catch(e){
            this.e('Oops!','Something went wrong, please try again!')
      
        }
    },
    async  autocompleteSearch () {		
        if(this.location == '') return this.i("Places field is empty!");
        this.i(this.location);

        var  autocomplete = new google.maps.places.Autocomplete((this.$refs['location']), {  
            types: ['(regions)'],
        });
         google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var near_place = autocomplete.getPlace();
            console.log("places")
            console.log(near_place)
        });
    },
      displayLocation(){
        var geocoder;
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(this.lat, this.lon);

        geocoder.geocode(
            {'latLng': latlng}, 
            function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var add= results[0].formatted_address ;
                        var  value=add.split(",");

                        count=value.length;
                        country=value[count-1];
                        state=value[count-2];
                        city=value[count-3];
                        console.log( "city name is: " + city);
                    }
                    else  {
                        console.log( "address not found");
                    }
                }
                else {
                    console.log( "Geocoder failed due to: " + status);
                }
            }
        );
    },
    myFunction: function () {		
      if(navigator.geolocation){
      navigator.geolocation.getCurrentPosition(this.showPosition);
      }else{
      this.error = "Geolocation is not supported."; 
        
      }
    },
	  showPosition:function (position) {	
      this.lat = position.coords.latitude;
      this.lon = position.coords.longitude;
    }
	}
}
</script>

<style>

</style>
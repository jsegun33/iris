
<template>

    <div>
  {{  this.languages[1].name + " samples" }}

              


            <!-- <v-select
                :options="locations.title"
                v-model="location"
                label="Choose Location"
               
                bottom
                autocomplete
                >
            </v-select>
              
            <v-select
                :options="languages"
                :value= this.languages[0].name 
                
              
              /> -->
   <!-- :option= "v-for='value in languages' :key='value.value'>{{ value.name }}" -->
                   <!-- <v-select :options="languages"> 
                          
                            <span v-for="value in languages" :key="value.name"> {{ value.name}}</span>
                 </v-select>   -->

                  <!-- <v-select :options="entidades" :item-text="id" :value="this.entidades[1].id" single-line auto prepend-icon="group_work" label="Seleccionar Grupo"></v-select>  

                <v-select v-model="form.lead_generator_id" 
                                prepend-icon="person" :items="appointments" 
                                label="Appointment Setter" item-value="id" 
                                :item-text="item => `ID: ${item.id} | ${item.client_name}`">
                    </v-select>
               
<pre>form = {{ form }}</pre> -->


<v-select :options="locations" label="title">
  <template v-slot:option="locations">
    <span :class="locations.title"></span>
    {{ locations.title }}
  </template>
</v-select>



           <pre>{{ $data }}</pre>
 </div>
</template>

<script src='https://unpkg.com/vue/dist/vue.js'></script>
<script src='https://unpkg.com/vuetify@1.0.10/dist/vuetify.min.js'></script>
<script>


export default {
        data () {
            return {
            location: null,
            language:null,
            locations: [
                { id: "1111", manager: 'Alice',  title: 'Water Cart 1' },
                { id: "2222", manager: 'Bob',    title: 'Water Cart 2' },
                { id: "3333", manager: 'Neysa',  title: 'Water Cart 3' }
            ],

            languages : [
                {name: "English",  value:"en"},
                {name: "French",   value:"fr"},
                {name: "Arabic",   value:"ar"},
                {name: "Swahili",   value:"sw"},
            ],
            tags: ['JavaScript', 'MVVM', 'Vue.js'],

             users: [
                { name: 'Foo Bar', email: 'foo@bar.com' },
                { name: 'John Doh', email: 'john@doh.com' }
                ],
                 entidades: [ { "id": 1 }, { "id": 2 } ],

                  "appointments": [{
                    "id": 1,
                    "client_name": 'John Smith'
                    }, {
                    "id": 2,
                    "client_name": 'Carl Larson'
                    }, {
                    "id": 3,
                    "client_name": 'Lennard Smith'
                    }],

                    form: {
      lead_generator_id: null
    }

            }
        
        }
}

</script>
<style>
.v-select .dropdown-menu {
  display:block;
}
.v-select {
  display: grid;
}
</style>
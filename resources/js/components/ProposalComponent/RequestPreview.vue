<template>
<div>

    <button class="open-button" @click="openForm()">Preview</button>

    <div class="chat-popup" id="myForm">
        <div class="box-body form-container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-header">
                        <img src="/img/rsilogo.png" alt="RSILogo" id="quoteslogo">
                        <small class="pull-right"><strong> Date: {{date}} </strong></small>
                    </h2>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-md-12">
                    <h3>Request for Proposal</h3>
                </div>
            </div>
            
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding: 0px;">
                            <p><b>Assured</b><b class="pull-right">:</b></p>
                            <p><b>Address</b><b class="pull-right">:</b></p>
                            <p><b>Unit</b><b class="pull-right">:</b></p>
                            <p><b>Coverage</b><b class="pull-right">:</b></p>
                        </div>
                        <div class="col-md-10" style="padding: 0px 0px 0px 10px;">
                            <p>{{personal.first_name}} {{personal.middle_name}} {{personal.last_name}}</p>
                            <p>{{personal.address}} {{personal.barangay}}, {{personal.city}}</p>
                            <p>{{motorcar.year}} {{motorcar.brand}} {{motorcar.model}} {{motorcar.bodyType}}</p>
                        </div>
                    </div>
                </div>

                <div class="row" v-if="coverages">
                    <div class="col-md-7">
                        <ol class="pull-right">
                            <li v-for="coverage in coverages" :key="coverage._id">{{coverage.PerilsName}}</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" >
                        <small><b>Note:</b></small> 
                        <ol>
                            <li v-if="motorcar.accessories"><small>Included Accessories</small></li>
                            <li v-if="motorcar.netWeight == 'less'"><small>Net Weight is Less than 3,930 KG</small></li>
                            <li v-if="motorcar.netWeight == 'over'"><small>Net Weight is Over 3,930 KG</small></li>
                        </ol>
                    </div>
                </div>
            </section>
            <button type="button" class="btn cancel" @click="closeForm()">Close</button>
        </div>
    </div>
</div>
    
</template>

<script>
export default {
    props: [
        'motorcar',
        'personal',
        'coverages'
    ],

    methods: {
        openForm() {
            document.getElementById("myForm").style.display = "block";
        },

        closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    },

    computed: {
        date() {
           let date = new Date()
           let day = date.getDate()
           let month = date.getMonth() + 1
           let year = date.getFullYear()
           return `${month} / ${day} / ${year}`
        }
    }
}
</script>

<style scoped>
/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: green;
  color: white;
  padding: 10px 10px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 50px;
  right: 28px;
  width: 280px;
  border-radius: 25px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 50px;
  right: 15px;
  border: 1px solid #f1f1f1;
  z-index: 9;
  border-radius: 10px;
}

/* Add styles to the form container */
.form-container {
  width: 550px;
  max-width: 500px;
  padding: 10px;
  background-color: white;
  display: inline-block;
}

/* Full-width textarea */
/* .form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
} */

/* When the textarea gets focus, do something */
/* .form-container textarea:focus {
  background-color: #ddd;
  outline: none;
} */

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 10px 10px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
  border-radius: 25px;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

#quoteslogo {
    width: 125px;
}
</style>
<template>
    <div class="container">
        <div class="row">
         
                <div class="col-md-12">
                    <h2 class="h1 text-center">Register</h2>
                    <hr>
                    <div v-for="err in errors" v-bind:key="err.id" class="error">
                        {{err[0]}}
                    </div>
                    <div v-html="rawhtml"></div>
                    <form class="container col-md-offset-3 col-md-6" @submit.prevent="formSubmiting()">
                        <div class="form-group row">
                            <label class="co">Name </label>
                            <input class="form-group col-md-12" value="" v-model="formdata.name" type="text" placeholder="UserName">
                        </div>
                         <div class="form-group row">
                            <label class="col-">Password </label>
                            <input class="form-group col-md-12" value="" v-model="formdata.password" type="password" placeholder="Password">
                        </div>
                        <div class="form-group row">
                            <label class="col-">Email </label>
                            <input class="form-group col-md-12" value="" v-model="formdata.email" type="email" placeholder="Email">
                        </div>
                        <div class="form-group row">
                            <label class="col-">Address </label>
                            <select class="col-md-3 country"  v-model="formdata.country" @change="getState(formdata.country)">
                                <option value="">Select Country</option>
                                <option v-bind:value="count.id"  v-for="count in countries" v-bind:key="count.id">{{count.name}}</option>
                            </select>
                            <select class="col-md-3"  v-model="formdata.state" @change="getcites(formdata.state)">
                                <option value="">Select State</option>
                                <option v-bind:value="state.id"  v-for="state in states" v-bind:key="state.id">{{state.name}}</option>
                            </select>
                            <select class="col-md-3"  v-model="formdata.city">
                                <option value="">Select City</option>
                                 <option v-bind:value="city.id"  v-for="city in cites" v-bind:key="city.id">{{city.name}}</option>
                            </select>
                        </div>
                        <div class="form-group row">
                          
                           <button class="btn btn-success btn-lg col-md-12" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</template>

<script>

export default({
    name:"register",
    data(){
        return {
            formdata:{
                name:null,
                password:null,
                email:null,
                state:"",
                country:"",
                city:""
            
            },
            countries:[],
            states:[],
            cites:[],
            errors:[],
            rawhtml:""
        }
    },
    methods:{
        formSubmiting(){
           
            console.log(this.formdata);
            axios.post("http://127.0.0.1:8000/frontendapi/register",this.formdata,
            {headers: {
               'Accept': 'application/json'
              }})
            .then(response=>{
               console.log(response.data.err+"========");
                    if(response.status==202){
                         var html ="<div class='alert alert-danger'>";
                            html+="<p>Please fill Required feilds</p>";
                            html +="</div>"; 
                            //  this.errors=response.data.err;
                          //  this.rawhtml=response;
                          this.errors=response.data.err;
                    }else{
                        alert("Register successfully");
                        this.formdata.name=null;
                    this.formdata.password=null;
                    this.formdata.email=null;
                    this.formdata.state="";
                    this.formdata.country="";
                    this.formdata.city="";
                    this.states=[];
                    this.cites=[];
                    this.rawhtml="";

                    }
                
                
            })
             .catch(err=>{console.log(err);})
            
            return false;
        },
        getCountry(){
            
            fetch("http://127.0.0.1:8000/frontendapi/getallcountry")
            .then(res=>res.json())
            .then(res=>{
                this.countries=res.country;
            })
            .catch(err=>{console.log(err);})
        },
        getState(id){
             this.formdata.state="";
             this.formdata.city="";
            this.states=[];
            this.cites=[];
            if(id !=''){
            fetch("http://127.0.0.1:8000/frontendapi/getStateBycountryId/"+id)
             .then(res=>res.json())
            .then(res=>{
                this.formdata.state="";
                this.states=res.state;
            })
             .catch(err=>{console.log(err);})
             }else{
                this.formdata.state="";
                this.states=[];
                
            }
        },
        getcites(id){
            if(id !=''){
            fetch("http://127.0.0.1:8000/api/getCitesByStateId/"+id)
             .then(res=>res.json())
            .then(res=>{
                this.formdata.city="";
                this.cites=res.cites;
            })
             .catch(err=>{console.log(err);})
            }else{
                this.formdata.city="";
                this.cites=[];
            }
        }
    },
    created(){
        this.getCountry();
    }
})
</script>
<style scoped>

select.col-md-3 {
    padding: 10px;
    margin-left:10px;
}
select.col-md-3.country {
    margin-left:0px  !important;
}
.col-{
    width:100%;
}
</style>
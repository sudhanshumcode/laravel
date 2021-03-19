<template>
    <div class="container vue-login-tem">
        <h2 class="h2 text-center">Login</h2>
        <hr>
        <div class="form-div row">
            
            <form @submit.prevent="userlogin()" class="col-md-offset-3 col-md-6">
                <div class="row">
                <div v-html="rawhtml" class="col-md-12"></div>
                </div>
                <div class="form-group">
                    <label class="c-12 h4">Email</label>
                    <input type="text" class="form-control col-md-12" placeholder="Email" v-model="formdata.email">
                </div>
                <div class="form-group">
                    <label class="co-12 h4">Password</label>
                    <input type="password" class="form-control col-md-12" placeholder="Password" v-model="formdata.password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg col-md-12">Login</button>
                 </div>
            </form>
         </div>
    </div>
</template>
<script>
export default ({
    name:"login",
    data(){
        return{
            formdata:{
                email:null,
                password:null
            },
            rawhtml:""
        }
    },
    methods:{
       userlogin(){
           axios.post("http://127.0.0.1:8000/frontendapi/login",this.formdata,
            {headers: {
               'Accept': 'application/json'
              }})
              .then(res=>{
                  if(res.status==202){
                      var html ="<div class='alert alert-danger'>";
                            html+="<p>Please fill Required feilds</p>";
                            html +="</div>"; 
                            this.rawhtml=html;
                  }else if(res.status==201){
                        var html ="<div class='alert alert-danger'>";
                            html+="<p>Invalid Details</p>";
                            html +="</div>"; 
                            this.rawhtml=html;
                  }else{
                       var html ="<div class='alert alert-success'>";
                            html+="<p>Login Successfully</p>";
                            html +="</div>"; 
                            setTimeout(function(){window.location.href = "/home"},1000);
                            this.rawhtml=html;
                  }
              })
       }
    }

    
})
</script>
<style scoped>

.container.vue-login-tem {
    border: 1px solid #ddd;
    padding: 10px;
}
</style>
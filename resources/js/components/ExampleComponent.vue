<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <ul class="nav nav-tabs">
                        <!--<li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                        <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                        <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>-->
                        <li  v-for="tab in tabs" v-bind:key="tab">
                            <a data-toggle="tab" v-bind:href='"#"+tab.title'>{{tab.title}}</a></li>
                    </ul>

                    <div class="tab-content">
                        <div v-bind:id="tab.title" v-for="(tab,index) in tabs" v-bind:key="index" class="tab-pane fade" v-bind:class="(index==1)? classArray : ''">
                        <h3>{{tab.title}}</h3>
                        <p>{{tab.content}}</p>
                        </div>
                        <!--div id="home" class="tab-pane fade in active show">
                        <h3>HOME</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                        <h3>Menu 1</h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                        </div-->
                            
                    </div>
                    <div >{{message}}</div>
                
                    <child @changetext="changeTxt" :childdata="childdata"></child>
            </div>
        </div>
    </div>
</template>

<script>
import child from './child';
    export default {
        data(){
            return {
              tabs:{
                  1:{
                      title:"Product",
                      content:"Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
                  },
                   2:{
                      title:"Orders",
                      content:"Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
                  },
                   3:{
                      title:"Post",
                      content:"Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
                  },
                 
              },
              classArray:["active","show","in"],
              message:"dddddd",
              childdata:"asdasdasd"
            };
        },
        methods:{
          changeTxt(value){
            this.message=value;
          }
                   
        },
        props:name,
        components:{
            child
        },
        mounted() {
            $("ul.nav.nav-tabs li:first-child").addClass("active");
            
            
        }
    }
</script>
<style>
.tab-content{
    background: #fff;
    padding: 15px;
    border: 1px solid #ddd;
}
</style>

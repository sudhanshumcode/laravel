<template>
    <div class="container">
        <h2>{{name}}</h2>
        sss
        {{childdata}}
        <button @click="changeText()">Change parent heading</button>
    </div>
</template>
<script>

export default ({
   name:"child",
   data(){
       return {name:"Child"}
   },
   methods:{
       changeText(){
           this.$emit('changetext',"New Title");
       }
   },
   props:['childdata']
})
</script>

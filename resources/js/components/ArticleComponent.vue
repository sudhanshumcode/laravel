<template>
    <div class="container"> 
        <h2>Articles</h2>
        <div class="row">
            <div class="col-md-offset-3 col-md-6 col-md-offset-3">
            <ul class="pagination">
                <li v-bind:class="[{disable: !pagination.next_page_url}]"><a href="#">Prev</a></li>
                <li><a href="">next</a></li>
            </ul>
                <div class="articles_show" v-for="article in articles" v.bind:key="article.id">
                <h3>{{article.title}}</h3>
                <p>{{article.body   }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                articles:[],
                article:{
                    id:"",
                    title:"",
                    body:""
                },
                article_id:""
            }
        },
        created(){
            this.fetchArticle()
        },
        methods:{
            fetchArticle(page_url){
             let vm=this;
             page_url=page_url|"http://127.0.0.1:8000/api/article";
                fetch("http://127.0.0.1:8000/api/article")
                .then(res=>res.json())
                .then(res=>{
                   this.articles=res.data;
                   vm.makePagination(res,res.links);
                }).catch(err=>console.log(err))
            },
            makePagination(meta,link){
                let current_page;
               link.forEach(function(item) {
                    Object.keys(item).forEach(function(key) {
                      if(item['active']=="true"){
                          current_page=item['url'];
                      }
                    });
                 });
            pagination ={
                  prev_page_url :(meta.prev_page_url ==null)?"":meta.prev_page_url,
                  next_page_url:meta.next_page_url,
                  current_page_url:current_page,
                  last_page:meta.last_page_url
              }
              console.log(pagination.prev_page_url+"=============="+pagination.next_page_url);
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
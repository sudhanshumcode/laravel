<template>
    <div class="container"> 
       
        <div class="row">
            <div class="col-md-offset-3 col-md-6 col-md-offset-3">
                 <h2 class="page-header">Articles</h2>
                 <p v-html="rawhtml"></p>
                 <form @submit.prevent="addArticle()">
                    <div class="form-group">
                        <label for="Article">Article Title:</label>
                        <input type="text" class="form-control" id="title" v-model="article.title"  placeholder="Article Title">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Article Body:</label>
                        <textarea  class="form-control" id="pwd"  v-model="article.body" placeholder="Article Content"></textarea>
                    </div>
                  
                    <button type="submit" class="btn btn-success btn-lg">{{submitBtnTxt}} Article</button>
                    <div class="icon-box" v-show="edit" @click="reloadArticle()"><i class="fa fa-refresh" aria-hidden="true"   ></i></div>
                    </form>
                 <br><br>
                <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li v-bind:class="{disabled: !pagination.prev_page_url}">
                            <a href="javascript:void(0)" aria-label="Previous" @click="fetchArticle(pagination.prev_page_url)">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                            </li>
                            <li class="disabled text-dark"><a href="javascript:void(0)">Page {{pagination.current_page_num}} for {{pagination.last_page}}</a></li>
                            <li v-bind:class="{disabled: !pagination.next_page_url}">
                            <a href="javascript:void(0)" aria-label="Next"  @click="fetchArticle(pagination.next_page_url)">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                            </li>
                        </ul>
                        </nav>
                <div class="articles_show card mb-3" v-for="article in articles" v-bind:key="article.id">
                <h3 class="card-header">{{article.title}}</h3>
                <p class="card-body">{{article.body   }}</p>
                
                 <button class="btn btn-primary btn-lg" @click="editArticle(article)">Edit</button>
             
                <button class="btn btn-danger btn-lg" @click="deleteArticle(article.id)">Delete</button>
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
                article_id:"",
                pagination:"",
                rawhtml:"",
                edit:false,
                submitBtnTxt:"Add"
            }
        },
        created(){
            this.fetchArticle()
        },
        methods:{
            fetchArticle(page_url){
             let vm=this;
             page_url=(page_url)?page_url:  "http://127.0.0.1:8000/api/article";
                fetch(page_url)
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
                      if(item['active']){
                          current_page=item['label'];
                          
                      }
                     // console.log(item['active']+"========");
                    });
                 });
           var  pagination ={
                  prev_page_url :(meta.prev_page_url ==null)?"":meta.prev_page_url,
                  next_page_url:meta.next_page_url,
                  current_page_num:current_page,
                  last_page:meta.last_page
              }
              this.pagination=pagination;
              console.log(pagination.current_page_num+"=============="+pagination.last_page);
            },
            deleteArticle(id){
              
               fetch('http://127.0.0.1:8000/api/article/'+id,{
               method: "delete",
               })
                .then(res=>res.json())
                .then(res=>{
                   this.rawhtml="<div class='alert alert-success text-dark'>Article Delete successfully</div>"
                 this.fetchArticle();
                 this.scrollToTop();    
                 return false;
                })
                .catch(err=>console.log(err))
            },
            addArticle(){
                console.log(this.article);
                if(this.edit==false){
                    //Adding new article
                     //update article
                    
                    axios.post('http://127.0.0.1:8000/api/article/',this.article)
                     .then(res=>res)
                    .then(res =>{
                       // console.log(res+"======"+res.data)
                        if(res.status != 200){
                            var html;
                            html ="<div class='alert-danger'>";
                            $.each(res.data, function(key, value) {
                                   html +="<p>"+value+"</p>";
                                });
                            html +="</div>";
                            this.rawhtml=html;
                        }else{
                        this.rawhtml="<div class='alert alert-success text-dark'>New Article Added</div>"
                        this.fetchArticle();
                        this.scrollToTop();
                        }
                        
                        return false;
                   })
                    .catch(err=>console.log(err))
                }else{
                    //update article
                    axios.put('http://127.0.0.1:8000/api/article/'+this.article.id,this.article)
                    .then(res=>res)
                    .then(res =>{
                        //console.log(res+"======"+res.data)
                      
                        if(res.status != 200){
                            var html;
                            html ="<div class='alert-danger'>";
                            $.each(res.data, function(key, value) {
                                   html +="<p>"+value+"</p>";
                                });
                            html +="</div>";
                            this.rawhtml=html;
                        }else{
                        this.article.id="";
                        this.article.title="";
                        this.article.body="";
                        this.submitBtnTxt="Add";
                        this.edit=!this.edit;
                        this.rawhtml="<div class='alert alert-success text-dark'>Article Update successfully</div>"
                        this.fetchArticle();
                        this.scrollToTop();
                        
                        }
                        return false;
                   })
                    .catch(err=>console.log(err))
                    return false;
                }

            },
            editArticle(article){
                
                this.article.id=article.id;
                this.article.title=article.title;
                this.article.body=article.body;
                this.submitBtnTxt="Update";
                this.edit=!this.edit;
                this.scrollToTop();
            },
            reloadArticle(){
                this.article.id="";
                        this.article.title="";
                        this.article.body="";
                        this.submitBtnTxt="Add";
                        this.edit=!this.edit;
            },
            scrollToTop() {
               $([document.documentElement, document.body]).animate({
                        scrollTop: $("body").offset().top
                    }, 1000);
           }
        },
         
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style >

.mb-3{
    padding:20px;
}
.btn-lg, .btn-group-lg > .btn ,.form-control{
    font-size: 15px;
    margin-bottom: 10px;
}
.fa{
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;

}
.fa-refresh:before{
content: "\f021";
}
.icon-box {
    display: inline;
    margin-left: 10px;
    margin-top: -10px;
}
</style>
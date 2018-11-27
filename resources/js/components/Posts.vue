<template>
    <div>
        <div class="col-md-12 mt-2" v-for="post in posts.data" :key="post.id">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3><label>{{post.p_title}}</label></h3>
                        </div>
                        <div class="col-md-6 postsbtn">
                            <button type="button" @click.prevent="editpost(post)" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editpost">
                                Edit
                            </button>
                            <button type="button" @click="deletepost(post.id)" class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </div>
                    </div>

                </div>
                <div class="card-body" id="p_content">
                    {{post.p_content}}
                </div>

                <hr/>
                <div class="col-md-12" v-for="com in post.comments">
                    <p class="comments"><i class="sm-font red">{{com.user.name}}</i> &nbsp <i class="sm-font">{{com.c_content}}</i> &nbsp &nbsp &nbsp &nbsp<i class="sm-font">{{com.created_at | mydate}}</i></p>
                </div>
                <div class="card-footer sm-font">
                    <div class="row">
                        <div class="col-md-6">
                            Add By :{{post.user.name}}
                        </div>
                        <div class="col-md-6">
                            {{post.created_at | mydate}}
                        </div>
                        <div @click="addcomment()" class="col-md-12">
                            <div class="col-md-6" id="combtn">
                                <span class="comm"><i class="fas fa-comment blue"></i> Comment</span>
                            </div>
                            <div class="col-md-12" id="comarea" @keyup.enter="sendcomment(post.id)">
                                   <textarea v-model="form.c_content" name="c_content" rows="1"
                                             class="form-control" :class="{ 'is-invalid': form.errors.has('c_content') }"></textarea>
                                <has-error :form="form" field="c_content"></has-error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editpost" tabindex="-1" role="dialog" aria-labelledby="editpostLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editpostLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updatepost" @keydown="form.onKeydown($event)">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Title</label>
                                <input v-model="form.p_title" type="text" name="p_title"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('p_title') }">
                                <has-error :form="form" field="p_title"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea v-model="form.p_content" name="p_content"
                                          class="form-control" rows="1" :class="{ 'is-invalid': form.errors.has('p_content') }"></textarea>
                                <has-error :form="form" field="p_content"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Updata</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                posts:{},
                form : new form({
                    id:        '',
                    p_title:   '',
                    p_content: '',
                    userid:    '',
                    c_content: '',
                    post_id:   ''
                })
            }
        },
        methods:{
            sendcomment(post_id){
                this.form.userid = $('#userid').val()
                this.form.post_id = post_id
                this.form.post('api/comment');
                fire.$emit('refresh')
            },
            addcomment(){
                $(document).on('click','#combtn',function () {
                    $(this).next('#comarea').show()
                })
            },
            deletepost(id){
                this.form.delete('api/post/'+id)
                fire.$emit('refresh')
            },
            updatepost(){
                this.form.put('api/post/'+this.form.id)
                    .then((res)=>{
                        $('#editpost').modal('hide')
                        fire.$emit('refresh')
                    })
            },
            loadposts(){
                // let gender = $('#gender').text()
                axios.get('api/post')
                    .then((res)=>{
                        this.posts = res
                        // console.log(res)
                    })
            },
            editpost(post){
                this.form.fill(post)
            }
        },
        created(){
            this.loadposts()
            fire.$on('refresh',()=>{
                this.loadposts()
            })
        },
        name: "Posts",
    }
</script>

<style scoped>

</style>
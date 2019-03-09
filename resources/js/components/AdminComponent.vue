<template>
    <div class="col-md-12 mb-5">
        <div class="row">
            <div class="col-md-12 mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    ADD ITEM
                </button>
            </div>
            <transaction-component @clicked = "getRequest"></transaction-component>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ITEM FORM</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <item-form :myforms="[
                            {
                            type:'text',
                            name:'Item Name',
                            item:''
                            },
                            {
                            type:'number',
                            name:'Item Stock',
                            item:''
                            },
                            {
                            type:'number',
                            name:'Item Treshold',
                            item:''
                            },
                            {
                            type:'textarea',
                            name:'Item Classification',
                            item:''
                            },
                            {
                            type:'text',
                            name:'Item Skill',
                            item:''
                            }
                            ]"></item-form>
                           
                    </div>
                    </div>
                </div>
            </div>
             <div class="col-md-4">
                 <request-items :transaction="this.requestForm" :maintransaction="this.maintract" @disablecheck="this.getRequest(request)"></request-items>
             </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                list: [],
                search:'',
                maxPageNum:0,
                currentPage:1,
                clickedItem:{},
                requestForm:[],
                maintract:{}
            }
           
        },
        computed:{
            item_list: function(){
                return this.list.filter(i=>{
                    return i.item_skill.isMatch(this.search) || i.item_name.isMatch(this.search) || i.item_classification.isMatch(this.search) || i.item_id.isMatch(this.search);
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
           getRequest(request){
               this.maintract = request;
               axios.get('/api/request/'+request.id).
                then(response=>{
                    response.data.forEach(i=>{
                        if(i.status=='Approve'){
                            i.action = true;
                        }else{
                            i.action = false;
                        }
                    })
                    this.requestForm = response.data;
                })
           }
        }
    }
</script>

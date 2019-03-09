<template>
    <div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ITEM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <span class="font-weight-bold">Item Name:</span>
                        <span>{{item.item_name}}</span>
                    </div>
                    <div>
                        <span class="font-weight-bold">Item Stock:</span>
                        <span>{{item.item_stock}}</span>
                    </div>
                    <div>
                        <span class="font-weight-bold">Item Classification:</span>
                        <span>{{item.item_classification}}</span>
                    </div>
                    <div>
                        <span class="font-weight-bold">Item Skill:</span>
                        <span>{{item.item_skill}}</span>
                    </div>
                    <div class="mt-3">
                        <div>
                            <label for="">Set Quantity <span class="text-danger">*Should no be lower than 0 or higher than the item stock</span></label>
                            <input type="number" v-model="item.item_qty" class="form-control" @keyup="checkQty(item)">
                            <label for="" v-show="checkQty(item)" class="text-danger">Should be scope with the item stock</label>
                        </div>
                        <!-- <div>
                            <label for="" class="">User</label>
                            <select name="" id="" class="form-control">
                                <option value="" v-for="user in users" :key="user.id">{{user.name}}</option>
                            </select>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" @click="outItem(item)">Request</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                users:[]
            }
        },
        props:['item'],
        mounted(){
            this.fetchUsers()
        },
        methods:{   
            checkQty(item){
                return (item.item_qty > item.item_stock);
            },
            outItem(item){

            },
            fetchUsers(){
                axios.get('api/users').
                then(response=>{
                    this.users = response.data
                    console.log(response.data)
                })
            }
        }
    }
</script>

<style scoped>

</style>
<template>
    <div class="card">
        <div class="card-header">
            <h3>Requested Items</h3>
        </div>
         <table class="table">
            <thead>
                <tr>
                <th scope="col">ITEM ID</th>
                <th scope="col">ITEM NAME</th>
                <th scope="col">CURRENT STOCK</th>
                <th scope="col">UNIT</th>
                <th scope="col">ITEM QTY</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="transactio in transact" :key="transactio.id">
                <th scope="row">{{transactio.item.item_id}}</th>
                <td>{{transactio.item.item_name}}</td>
                <td class="text-right">{{transactio.item.item_stock}}</td>
                <td>{{transactio.item.item_unit}}</td>
                <td>
                    {{transactio.request_qty}}
                </td>
                <td>
                    <input type="checkbox" class="form-control" v-model="transactio.action" :disabled = "transactio.status != 'Pending' || send">
                </td>
                <!-- <td v-else>
                    <input type="checkbox" class="form-control" v-model="transactio.action" checked>
                </td> -->
                </tr>
            </tbody>
        </table>
        <div class="card-footer">
            <div class="form-group">
                <textarea class="form-control" placeholder="Remarks" v-model="maintransaction.transaction_remarks"></textarea>
            </div>
            <div class="progress mb-3" v-show="sending">
                <div class="progress-bar" role="progressbar" 
                aria-valuemin="0" aria-valuemax="100" :style="{width:progress+'%'}">
                    <span class="sr-only">70% Complete</span>
                    SENDING REQUEST
                </div>
            </div> 
            <button class="btn btn-primary" @click="sendRequest(transaction,maintransaction)">Submit to User</button>
        </div>
    </div>  
</template>

<script>
    export default {
        props:['transaction','maintransaction'],
        data(){
            return{
                send:false,
                transact:this.transaction,
                sending:true,
                progress:0
            }
        },
        mounted(){
        },
        watch:{
            transaction:function(newVal){
                this.transact = newVal;
            }
        },
        methods:{
            sendRequest(transact,maintransaction){
                transact.forEach(i=>{
                    delete i.item;
                    delete i.created_at;
                    delete i.update_at;
                })
                
                if(maintransaction.transaction_remarks != null){
                    axios.post('/api/transactionRemark',{id:transact[0].request_transaction_id,remarks:maintransaction.transaction_remarks})
                    .then(response=>{
                        console.log("Successfully Sended Remarks")
                    })
                }
                this.sending = true;
                transact.forEach(i=>{
                    axios.post('/api/transactionUser',i)
                    .then(response=>{
                        console.log(response)
                        if(transact[transact.indexOf(i) + 1] == null){
                            alert('SEND SUCCESS');
                             this.$emit('erase');
                        }
                    })
                })
                this.$emit('erase');
                // console.log(JSON.stringify(transact))
            }
        }
    }
</script>

<style scoped>

</style>
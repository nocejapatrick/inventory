<template>
    <div class="row">
        <div class="col-md-4 mt-4" v-for="transaction in transactions" :key="transaction.id">
            <div class="card">
                <div class="card-header">{{'Transaction '+transaction.id}}<br>
                    <small>{{'Date Requested '+transaction.created_at}}</small>
                </div>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">INDEX</th>
                            <th scope="col">ITEM ID</th>
                            <th scope="col">ITEM NAME</th>
                            <th scope="col">ITEM QTY</th>
                            <th scope="col">ITEM UNIT</th>
                            <th scope="col">REQUEST ITEM STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(request,index) in transaction.request" :key="request.id" :class="{'bg-success': request.status == 'Approve','bg-danger text-white':request.status=='Decline','bg-warning':request.status=='Pending'}">
                            <th>{{index + 1}}</th>
                            <th scope="row">{{request.item.item_id}}</th>
                            <td>{{request.item.item_name}}</td>
                            <td>{{computeStock(request)}}</td>
                            <td>{{request.item.item_unit}}</td>
                            <td>{{request.status}}</td>
                            </tr>
                        </tbody>
                    </table>
                <div class="card-footer">
                    <div class="form-group">
                        <textarea class="form-control" readonly v-model="transaction.transaction_remarks"></textarea>
                    </div>
                    <button class="btn btn-primary">Re-Request</button>
                    <button class="btn btn-primary" @click="downloadRequest(transaction)">Download Request</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
       data(){
           return{
               transactions:[]
           }
       },
       mounted(){
           this.fetchUsersTransactions()
           this.$root.$on('success',data=>{
                this.fetchUsersTransactions()
           });
       },
       methods:{
           fetchUsersTransactions(){
               axios.get('/api/users/'+user.id)
               .then(response=>{
                   this.transactions = response.data.transaction;
               })
           },
           computeStock(request){
                if(request.item.item_unit == 'pcs'){
                    console.log("QWE")
                    return Math.floor(parseInt(request.request_qty));
                }
                return request.request_qty.toFixed(2);
            },
            downloadRequest(transaction){
                // console.log(JSON.parse(JSON.stringify(transaction)));
                axios.post('/api/pdf',transaction)
                .then(response=>{
                    console.log(response);
                })
            }
       }
    }
</script>

<style scoped>

</style>
<template>
    <div v-if="myrequests != ''" class="card">
        <div class="card-header">
            <h3>Request Form</h3>
        </div>
         <table class="table">
            <thead>
                <tr>
                <th scope="col">ITEM ID</th>
                <th scope="col">ITEM NAME</th>
                <th scope="col">ITEM STOCK</th>
                <th scope="col">ITEM UNIT</th>
                <th scope="col">ITEM QTY</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="request in myrequests" :key="request.id">
                <th scope="row">{{request.item_id}}</th>
                <td>{{request.item_name}}</td>
                <td>{{computeStock(request)}}</td>
                <td>{{request.item_unit}}</td>
                <td width="120">
                    <input type="text" class="form-control" v-model="request.request_qty" @keydown="compareString($event, request)" @keyup="compareNum(request)">
                </td>
                <td>
                    <div href="" @click="deleteItem(request)" class="delete-item-icon">X</div>
                </td>
                </tr>
            </tbody>
        </table>
        <div class="card-footer">
            <div class="progress mb-3" v-show="sending">
                <div class="progress-bar" role="progressbar" 
                aria-valuemin="0" aria-valuemax="100" :style="{width:progress+'%'}">
                    <span class="sr-only">70% Complete</span>
                    SENDING REQUEST
                </div>
            </div> 
            <button class="btn btn-primary" @click="sendRequest(requests)">SUBMIT REQUEST</button>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                user_id:'',
                myrequests:'',
                progress:0,
                progressMax:0,
                sending:0,
                
            }
        },
        mounted(){
            // this.myrequests = this.requests;
            this.setsRequests();
        },
        computed:{
        },
        watch:{
            requests(){
                this.setsRequests();
            }
        },
        props:['requests'],
        methods:{
            compareString(e, request){
                if(isNaN(e.key) && e.key != 'Backspace'){
                    e.preventDefault();
                    return false;
                };
            },
            compareNum(request){
                if(request.request_qty > request.item_stock){
                    request.request_qty = request.item_stock;
                }
            },
            deleteItem(e){
               this.requests.splice(this.requests.indexOf(e),1);
            },
            sendRequest(requests){
                this.sending = 1;
                axios.get('/api/user').
                then(response=>{
                    this.user_id = response.data.id;
                    axios.post('/api/transaction/',{user_id:this.user_id}).
                    then(response=>{
                        this.myrequests.forEach(i=>{
                            i.request_transaction_id = response.data.transaction_id;
                            axios.post('/api/request',i).
                            then(response=>{
                                this.progress += Math.ceil((10 / (requests.length*10))*100);
                                 if(this.progress >= 100){
                                     this.progress += Math.ceil((10 / (requests.length*10))*100);
                                     var my = this;
                                     setTimeout(function(){
                                        my.sending = 0;                   
                                        my.$root.$emit('success');   
                                       my.progress = 0;
                                         alert('SUCCESSFULLY SEND REQUESTS');
                                     }, 1000);
                                }
                            })
                        })
                    })
                });
            },
            computeStock(request){
                if(request.item_unit == 'pcs'){
                    return Math.floor(parseInt(request.item_stock));
                }
                return request.item_stock.toFixed(2);
            },
            setsRequests(){
                this.myrequests = this.requests;
            }
        }
    }
</script>

<style scoped>

</style>
<template>
    <div class="col-md-8">
        <div class="col-md-12">
            <h2>User Requests</h2>
            <input type="text" class="form-control" v-model="search">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Request ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Date Issued</th>
                    <th scope="col">Request Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="request in filterSearch" :key="request.id" class="request-item-hover" @click="getRequest(request,filterSearch)">
                    <th scope="row">{{request.id}}</th>
                    <td>{{request.user.name}}</td>
                    <td>{{request.created_at}}</td>
                    <td class="text-dark">{{request.status}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                search:'',
                requests:[],
                requestForm:[]
            }
        },
        computed:{
            filterSearch(){
                return this.requests.filter(i=>{
                    return i.id.isMatch(this.search) || i.user.name.isMatch(this.search);
                })
            }
        },
        mounted(){
            this.getRequests();
        },
        methods:{
            getRequests(){
                axios.get('/api/transaction').
                then(response=>{
                    this.requests = response.data;
                })
                
            },
            getRequest(request){
                // console.log(JSON.stringify(request));
                this.$emit('clicked',request);
                // axios.get('/api/request/'+request.id).
                // then(response=>{
                //     this.requestForm = response.data;
                // })
            }
        }
    }
</script>

<style scoped>

</style>
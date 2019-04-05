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
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="request in filterSearch" :key="request.id" class="request-item-hover" @click="getRequest(request,filterSearch)">
                    <th scope="row">{{request.id}}</th>
                    <td>{{request.user.name}}</td>
                    <td>{{months[new Date(request.created_at).getMonth()] +  ' '+ new Date(request.created_at).getDate() +', '+new Date(request.created_at).getFullYear() +' | '+ getTime(request.created_at)+':'+ getMinutes(request.created_at) +' '+ getAmOrPm(request.created_at)}}</td>
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
                requestForm:[],
                months:[]
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
            this.months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
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
            },
            getTime(created_at){
                const arrayHrs = [12,1,2,3,4,5,6,7,8,9,10,11,12,1,2,3,4,5,6,7,8,9,10,11];
                return arrayHrs[new Date(created_at).getHours()];
            },
            getAmOrPm(created_at){
                var ampm = (new Date(created_at).getHours() < 12) ? "AM" : "PM";
                return ampm;
            },
            getMinutes(created_at){
                var minute = new Date(created_at).getMinutes();
                if(minute < 10){
                    minute = "0" + minute;
                }
                return minute;
            }
        }
    }
</script>

<style scoped>

</style>
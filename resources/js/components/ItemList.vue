<template>
    <div class="col-md-12">
        <div class="row">
             <div class="col-md-8" id="inventory-table" :class="{'col-md-8':myuser=='User','col-md-12':myuser=='Admin'}">
                <input type="text" class="form-control" v-model="search">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">ITEM ID</th>
                        <th scope="col">ITEM NAME</th>
                        <th scope="col">ITEM STOCK</th>
                        <th scope="col">ITEM UNIT</th>
                        <th scope="col" class="text-center">ITEM CLASSICIFICATION</th>
                        <th scope="col" v-if="myuser == 'Admin'">ITEM THRESHOLD</th>
                        <th scope="col">ITEM SKILL</th>
                        </tr>
                    </thead>
                    <tbody v-if="myuser == 'User'">
                        <tr v-for="item in item_list" :key="item.id" class="item-highlight user-select-none" @click="setItem(item)" >
                            <th scope="row">{{item.item_id}}</th>
                            <td>{{item.item_name}}</td>
                            <td width="120" class="text-right">
                                <!-- <input type="number" class="form-control" name="" id="" v-model="item.item_stock" v-on:change="updateStock(item.item_stock,item.id)"> -->
                                {{computeStock(item)}}
                            </td>
                            <td>{{item.item_unit}}</td>
                            <td class="text-center">{{item.item_classification}}</td>
                            <td v-if="myuser == 'Admin'">{{computeThreshold(item.item_threshold)}}</td>
                            <td>{{item.item_skill}}</td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr v-for="item in item_list" :key="item.id" class="user-select-none" :class="{'bg-danger':(item.item_threshold/2) >= item.item_stock,'bg-warning':item.item_threshold >= item.item_stock}">
                            <th scope="row">{{item.item_id}}</th>
                            <td>{{item.item_name}}</td>
                            <td width="120" class="text-right">
                                <!-- <input type="number" class="form-control" name="" id="" v-model="item.item_stock" v-on:change="updateStock(item.item_stock,item.id)"> -->
                                {{computeStock(item)}}
                            </td>
                            <td>{{item.item_unit}}</td>
                            <td class="text-center">{{item.item_classification}}</td>
                            <td v-if="myuser == 'Admin'">{{computeThreshold(item)}}</td>
                            <td>{{item.item_skill}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item" @click="paginatePrev()"><div class="page-link" href="#">Previous</div></li>
                            <li class="page-item" :class="{active: n==currentPage}" v-for="n in maxPageNum" :key="n.id" @click="fetchItems(n)">
                                <div class="page-link" href="#" >{{n}}</div>
                            </li>
                            <li class="page-item" @click="paginateNext()"><div class="page-link" href="#">Next</div></li>
                        </ul>
                    </nav>
                </div>
                <!-- <modal-component :item = "clickedItem"></modal-component> -->
            </div>
            <div class="col-md-4" v-if="myuser=='User'">
                <request-form :requests="requests"></request-form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['action'],
         data(){
            return {
                list: [],
                search:'',
                maxPageNum:0,
                currentPage:1,
                clickedItem:{},
                requests:[],
                myuser:''
            }
        },
        computed:{
            item_list: function(){
                return this.list.filter(i=>{
                    return i.item_skill.isMatch(this.search) || i.item_name.isMatch(this.search) || i.item_classification.isMatch(this.search) || i.item_id.isMatch(this.search) || i.item_unit.isMatch(this.search);
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.fetchItems(1)
            this.myuser = user.role;
            this.$root.$on('send',data=>{
                 this.fetchItems(1)
            })
            this.$root.$on('success',data=>{
                console.log("SUCCSS")
                this.requests = [];
            })
        },
        methods:{
            fetchItems(page){
                this.currentPage = page;
                axios.get('/api/item?page='+page).
                then(item=>{
                    this.list = item.data.data.data;
                    this.maxPageNum = item.data.pagination.last_page
                })
            },
             paginateNext(){
                if(this.currentPage < this.maxPageNum){
                    this.currentPage++;
                }else{
                    this.currentPage = 1;
                }
                this.fetchItems(this.currentPage);
            },
            paginatePrev(){
                if(this.currentPage > 1){
                    this.currentPage--;
                }else{
                    this.currentPage = this.maxPageNum;
                }
                this.fetchItems(this.currentPage);
            },
            lower(item){
                return item.toLowerCase();
            },
            updateStock(item_stock,id){  
                axios.put('/api/item/'+id,
                    {
                        stock:item_stock
                    }
                )
                .then(response =>{
                    console.log(response)
                })
            },
            setItem(item){
                if(!this.requests.includes(item)){
                    this.requests.push(item);
                }
            },
            computeStock(request){
                if(request.item_unit == 'pcs'){
                    return Math.floor(parseInt(request.item_stock));
                }
                return request.item_stock.toFixed(2);
            },
            computeThreshold(request){
                if(request.item_unit == 'pcs'){
                    return Math.floor(parseInt(request.item_threshold));
                }
                return request.item_threshold.toFixed(2);
            }
        }
    }
</script>

<style scoped>

</style>
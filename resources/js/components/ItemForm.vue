<template>
    <div>
        <div class="form-group" v-for="myform in forms" :key="myform.id">
            <label>{{myform.name}}</label>
            <input :type="myform.type" class="form-control" v-model="myform.item" step="any">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Unit</label>
            <select class="form-control" v-model="forms.item_unit">
                <option value="pcs">Pieces</option>
                <option value="m">Meters</option>
                <option value="Kg">Kilograms</option>
                <option value="g">Grams</option>
                <option value="cm">Centimeters</option>
                <option value="mm">Millimeters</option>
                <option value="in">Inches</option>
                <option value="ft">Feet</option>
                <option value="yd">Yards</option>
                <option value="l">Liters</option>
                <option value="ml">Milliliters</option>
            </select>
        </div>
         <div class="form-group">
            <button class="btn btn-primary btn-block" @click="sendForm($event)">SEND</button>
        </div>
    </div>
</template>

<script>
    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    export default {
        data(){
            return{
                item:{
                    name:'',
                    skill:'',
                    classification:''
                },
                forms:[]
            }
        },
        props:['myforms'],
        mounted() {
            this.forms = this.myforms
            console.log('Component mounted.')
        },
        methods:{
            sendForm(e){
                var value = {
                    item_id:getRandomInt(100000,999999),
                    item_name:this.forms[0].item,
                    item_stock:this.forms[1].item,
                    item_threshold:this.forms[2].item,
                    item_classification:this.forms[3].item,
                    item_skill:this.forms[4].item,
                    item_unit:this.forms.item_unit
                };

                // console.log(value)

                this.forms.forEach(i=>{
                    i.item = ""
                })
                // this.myforms[0].item = ""
         
                axios.post('/api/item',value).
                then(response=>{
                    alert(response.data)
                    this.$root.$emit('send',value);
                })
                
            }
        }
    }
</script>

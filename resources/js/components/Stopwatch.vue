<template>
    <div id='main'>

            <button @click="startwatch()">start</button>
            <button @click="stopwatch()">stop</button>
        <button type='button' ref="onstart" @click='ss()'>Start / Stop</button>
        <input type='text' v-on:keyup.32="ss" v-model='displayValue' ref='disp'/>
        <button type='button' @click='r'>Reset</button>
    </div>
</template>

<script>
export default {
    props:["hold", "agent_id", "autostart", 'istimer', 'switch', 'i', 'start'],
    name: "Stopwatch",
    data() {
        return {
            t: [0, 0, 0, 0, 0, 0, 0, 1],
            displayValue: 0,
            laps: [],
            init: 1,
            state: 0
        }
    },
    mounted() {
        var vm = this
        if(vm.hold){
            vm.t = vm.hold
        }

        vm.init = 1

        vm.load()
    },

    methods: {



        startwatch(){
            var vm = this


            vm.t[vm.t[2]] = (new Date()).valueOf();
            vm.t[2] = 1
            vm.t[4] = setInterval(vm.disp, 43);
            if(this.start == true){
                axios.post('/api/agents', {istimer: true, id: vm.agent_id, date_started: vm.t })
            }else{
                axios.post('/api/agents', {istimer: false,id: vm.agent_id,hold: vm.t })

            }
        },
        stopwatch(){
            var vm = this

            vm.t[2] = 0
            clearInterval(vm.t[4]);
            vm.t[3] += vm.t[1] - vm.t[0];
            vm.laps.push({no: vm.t[7]++, current: vm.format(vm.t[1] - vm.t[0]), runningTotal: vm.format(vm.t[3])});
            vm.t[4] = vm.t[1] = vm.t[0] = 0;
            vm.disp();
            if(this.start == true){
                axios.post('/api/agents', {istimer: false, id: vm.agent_id,date_started: vm.t })
            }else{
                axios.post('/api/agents', {istimer: true,id: vm.agent_id, hold: vm.t })
            }
        },


        ss() {

            var vm = this
            vm.t[vm.t[2]] = (new Date()).valueOf();

            vm.t[2] = 1-vm.t[2]


/*
            //vm.t[2] = vm.start
            if(vm.start && this.init == 1){
                vm.init = 0
                console.log(1, vm.start, vm.init)
                axios.post('/api/agents', {istimer: false, id: vm.agent_id, hold: vm.t}).then(response =>{
                    this.$emit('axiosresponse', response.data)
                })
            }else if(vm.start == false && this.init == 1 ){
                vm.init = 0
                axios.post('/api/agents', {istimer: true, id: vm.agent_id, date_started: vm.t}).then(response =>{
                    this.$emit('axiosresponse', response.data)
                })
            }else if(vm.start && this.init == 0){
                console.log(3)
                axios.post('/api/agents', {istimer: !this.start, id: vm.agent_id, hold:  vm.t}).then(response =>{
                    this.$emit('axiosresponse', response.data)
                })
            }else if(vm.start == false && this.init == 0 ){
                console.log(4)
                axios.post('/api/agents', {istimer: !this.start, id: vm.agent_id, date_started: vm.t}).then(response =>{
                    this.$emit('axiosresponse', response.data)
                })
            }*/

         /*   console.log(this.autostart , this.istimer, this.init)
            if(this.autostart == false && this.istimer === false && vm.init == false){
                this.init = 0
                console.log('timer', 1)
                axios.post('/api/agents', {autostart: false, istimer: false, id: vm.agent_id, hold: vm.t})
                this.$emit('stopTimer', this.i)
            }else{

            }

            if(this.autostart == true && this.istimer === false && vm.init == false){
                this.init = 0
                console.log('timer', 2)
                axios.post('/api/agents', {autostart: true, istimer: false, id: vm.agent_id, hold: vm.t})
                this.$emit('stopTimer', this.i)
            }else{
                this.$emit('stopTimer', this.i)
            }
*/
           /* if(this.autostart == true && this.istimer === true && vm.init == true){
                this.init = 0
                console.log('timer', 4)
                axios.post('/api/agents', {autostart: true, istimer: true, id: vm.agent_id, date_started: vm.t})
                this.$emit('stopTimer', this.i)
            }*/
            /*if(this.autostart == false && this.istimer === true ){
                console.log('timer', 3)
                axios.post('/api/agents', {autostart: false, istimer: true, id: vm.agent_id, date_started: vm.t})
                this.$emit('stopTimer', this.i)
            }*/



            if (0 == vm.t[2]) {
                console.log(5, vm.t)
                clearInterval(vm.t[4]);
                vm.t[3] += vm.t[1] - vm.t[0];
                vm.laps.push({no: vm.t[7]++, current: vm.format(vm.t[1] - vm.t[0]), runningTotal: vm.format(vm.t[3])});
                vm.t[4] = vm.t[1] = vm.t[0] = 0;
                vm.disp();
                this.state = 0

            }else{
                vm.t[4] = setInterval(vm.disp, 43);
                this.state = 1
            }
        },

        r() {
            var vm = this
            if (vm.t[2]) vm.ss();
            vm.t[4] = vm.t[3] = vm.t[2] = vm.t[1] = vm.t[0] = 0;
            vm.disp();
            document.getElementById('lap').innerHTML = '';
            vm.t[7] = 1;
        },
        disp() {
            var vm = this
            /*
            console.log(this.autostart, ',', this.istimer, ", ", this.switch, ",", this.state)
            if(this.autostart === true && this.istimer === true &&  this.switch === 1){
                this.$emit('switchevent', 0)
               this.$refs.onstart.click()
            }
            if(this.autostart === false && this.istimer === true &&  this.switch === 1){
                this.$emit('switchevent', 0)
                this.$refs.onstart.click()
            }
            if(this.autostart === true && this.istimer === false &&  this.switch === 1){
                this.$emit('switchevent', 0)
                this.$refs.onstart.click()
            }
            if(this.autostart === false && this.istimer === false &&  this.switch === 1){
                this.$emit('switchevent', 0)
                this.$refs.onstart.click()
            }*/


            if (vm.t[2]) vm.t[1] = (new Date()).valueOf();
            vm.t[6] = vm.format(vm.t[3] + vm.t[1] - vm.t[0]);
            vm.displayValue = vm.t[6]
        },
        format(ms) {
            var vm = this
            // used to do a substr, but whoops, different browsers, different formats
            // so now, this ugly regex finds the time-of-day bit alone
            var d = new Date(ms + vm.t[5]).toString()
                .replace(/.*([0-9][0-9]:[0-9][0-9]:[0-9][0-9]).*/, '$1');
            var x = String(ms % 1000);
            while (x.length < 3) x = '0' + x;
            d += '.' + x;
            return d;
        },
        load() {
            var vm = this
            vm.t[5] = new Date(1970, 1, 1, 0, 0, 0, 0).valueOf();
            vm.t[6] = vm.$refs.disp;
            vm.disp();

        }
    }
}
</script>

<style scoped>

</style>

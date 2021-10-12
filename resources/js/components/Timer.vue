<template>
    <span>{{hours + ":" + minutes + ":" + seconds}}</span>
</template>

<script>
export default {
    props: ['agent'],
    data() {
        return {
            countFrom: null,
            id: null,
            interval: null,
            seconds: 0,
            minutes: 0,
            hours: 0,
            days: 0,
            years: 0
        }
    },
    mounted() {
        var vm = this

        this.interval = setInterval(() => {
            var date_started = new Date(this.agent.date_started),
            date_now = this.$root.now

            vm.seconds = Math.floor((date_now - (date_started))/1000),
            vm.minutes = Math.floor(vm.seconds/60),
            vm.hours = Math.floor(vm.minutes/60),
            vm.days = Math.floor(vm.hours/24),

            vm.years = Math.floor(vm.days/365);
            if(vm.years%4==0){
                vm.days = vm.days -(vm.years*366);
                vm.hours = vm.hours-(vm.years*366*24)-(vm.days*24);
                vm.minutes = vm.minutes-(vm.years*366*24*60)-(vm.days*24*60)-(vm.hours*60);
                vm.seconds = vm.seconds-(vm.years*366*24*60*60)-(vm.days*24*60*60)-(vm.hours*60*60)-(vm.minutes*60);

            }else{


                vm.days = vm.days -(vm.years*365);
                vm.hours = vm.hours-(vm.years*365*24)-(vm.days*24);
                vm.minutes = vm.minutes-(vm.years*365*24*60)-(vm.days*24*60)-(vm.hours*60);
                vm.seconds = vm.seconds-(vm.years*365*24*60*60)-(vm.days*24*60*60)-(vm.hours*60*60)-(vm.minutes*60);
            }
        },1000);
    },
    methods: {
        clearDate() {

            clearTimeout(this.interval);

        },

    },
    computed: {

    }

}
</script>

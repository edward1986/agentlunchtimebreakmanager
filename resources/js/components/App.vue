<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>

                                <th scope="col">Date Started</th>
                                <th scope="col">Status</th>
                                <th scope="col">Timer</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(agent, index) in agents" :key="index">

                                <td>{{ agent.date_started }}</td>
                                <td>{{ agent.status }}</td>
                                <td>
                                    <stopwatch
                                        :start="agent.istimer"
                                        :i="index"
                                        @axiosresponse="agents[index] = $event"
                                        ref="date_started"
                                        @switchevent="onswitch($event, 'timer', true)"
                                        @stopTimer="stopTimer($event, 'timer', true)"
                                        :istimer="true"
                                        :autostart="agent.istimer"
                                        :agent_id="agent.id"
                                        :switch="switchHold"
                                        :hold="agent.date_started"/>
                                </td>
                                <td>
                                    <stopwatch
                                        :start="agent.istimer"
                                        :i="index"
                                        ref="hold"
                                        @axiosresponse="agents[index] = $event"
                                        @switchevent="onswitch($event, 'hold', false)"
                                        @stopTimer="stopTimer($event, 'hold', false)"
                                        :istimer="false"
                                        :autostart="!agent.istimer"
                                        :switch="switchTimer"
                                        :agent_id="agent.id"
                                        :hold="agent.hold"/>
                                </td>
                                <td>
                                    <button @click="onStopStart(index)">start</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Timer from './Timer'
import Stopwatch from "./Stopwatch";

export default {
    components: {
        Timer,
        Stopwatch
    },
    data() {
        return {
            switchTimer: 0,
            switchHold: 0,
            timer: true,
            agents: [],
            isVisible: true
        }
    },

    mounted() {
        var vm = this
        axios.get('/api/agents').then(response => {
            this.agents = response.data
           return this.agents
        }).then(agent =>{
            this.agents.forEach((agent, index) => {
                agent.istimer ? vm.$refs.date_started[index].startwatch() :  vm.$refs.hold[index].startwatch()
            })
        })
    },
    methods: {
        onStopStart(index){
            var agent = this.agents[index]
            if(agent.istimer){
                this.$refs.hold[index].startwatch()
                this.$refs.date_started[index].stopwatch()
            }else{
                this.$refs.date_started[index].startwatch()
                this.$refs.hold[index].stopwatch()
            }


        },
        onswitch(event, state){
            console.log(event, state)
            if(state === "timer"){
                this.switchTimer = 0
            }else if(state === "hold") {
                this.switchHold = 0
            }
        },
        stopTimer(event, state, istimer){
            console.log(event)
            if(state === "hold"){
                this.$refs.date_started[event].ss()
            }
            if(state === "timer" && istimer == false){
                this.$refs.hold[event].ss()
            }
                this.agents[event].istimer = !this.agents[event].istimer


        }
    }
}
</script>

